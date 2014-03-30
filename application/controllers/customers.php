<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_type = $this->session->userdata('user_type');

        if($user_type != '3') redirect(site_url('errors/access_denied'));

        $this->load->model('Customer_model', 'customer');
    }

    public function index()
    {
        $this->layout->view('customers/index_view');
    }

    public function get_list(){
    	$start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $result = $this->customer->get_list($start, $limit);

        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }

    public function get_list_total(){

        $total = $this->customer->get_list_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function save(){
        $data = $this->input->post('data');

        if(empty($data)){

            $json = '{"success": false, "msg": "No data for save."}';

        }else{

            if(empty($data['name'])){

                $json = '{"success": false, "msg": "No name found."}';

            }else if(empty($data['address'])){

                $json = '{"success": false, "msg": "No address found."}';

            }else{

                if($data['isupdate']){

                    $rs = $this->customer->update($data);

                    if($rs){
                            $json = '{"success": true}';
                        }else{
                            $json = '{"success": false, "msg": "Save error."}';
                        }

                }else{

                    $data['code'] = empty($data['code']) ? generate_serial('CUSTOMER') : $data['code'];
                    $duplicated = $this->customer->check_duplicate_name($data['name']) || $this->customer->check_duplicate_code($data['code']);

                    if($duplicated){

                        $json = '{"success": false, "msg": "Name/Code duplicated"}';

                    }else{

                        $rs = $this->customer->save($data);

                        if($rs){

                            $json = '{"success": true, "msg": "inserted"}';

                        }else{

                            $json = '{"success": false, "msg": "Save error."}';

                        }
                    }
                }
            }
        }

        render_json($json);
    }

    public function remove(){
        $code = $this->input->post('code');
        if(empty($code)){
            $json = '{"success": false, "msg": "No code found."}';
        }else{
            $result = $this->customer->remove($code);
            if($result){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Database error, please check your data."}';
            }
        }
        render_json($json);
    }

    public function search(){
        $query = $this->input->post('query');
        if(empty($query)){
            $json = '{"success": false, "msg": "No query found."}';
        }else{
            $result = $this->customer->search($query);

            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }
    /*
    * Get customer detail
    *
    * @params   $customer_code The Customer code.
    */
    public function get_detail(){

        $customer_code = $this->input->post('customer_code');

        if(empty($customer_code)){
            $json = '{"success": false, "msg": "No customer found."}';
        }else{
            $result = $this->customer->get_detail($customer_code);

            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

}
