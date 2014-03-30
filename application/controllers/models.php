<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Models extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_model = $this->session->userdata('user_type');
        if($user_model != '3') redirect(site_url('errors/access_denied'));

        $this->load->model('Model_model', 'model');
    }

    public function index()
    {
        $data['brands'] = $this->model->get_brand_list();
        $this->layout->view('models/index_view', $data);
    }

    public function get_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $result = $this->model->get_list($start, $limit);
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_list_total(){

        $total = $this->model->get_list_total();
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

            }else{

                if($data['isupdate']){

                    $rs = $this->model->update($data);

                    if($rs){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false, "msg": "Save error."}';
                    }

                }else{

                    $data['code'] = empty($data['code']) ? generate_serial('PRODUCT_MODEL') : $data['code'];
                    $duplicated = $this->model->check_duplicate_name($data['name']) || $this->model->check_duplicate_code($data['code']);

                    if($duplicated){

                        $json = '{"success": false, "msg": "Name/Code duplicated"}';

                    }else{

                        $rs = $this->model->save($data);

                        if($rs){

                            $json = '{"success": true}';

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
            $result = $this->model->remove($code);
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
            $result = $this->model->search($query);

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
