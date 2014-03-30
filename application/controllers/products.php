<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_type = $this->session->userdata('user_type');

        if($user_type != '3') redirect(site_url('errors/access_denied'));


        $this->load->model('Product_model', 'product');
        $this->load->model('Model_model', 'model');
    }

    public function index()
    {

        $data['customers'] = $this->product->get_customer();
        $data['types'] = $this->product->get_type();
        $data['brands'] = $this->product->get_brand();
        $data['colors'] = $this->product->get_color();
        $data['suppliers'] = $this->product->get_supplier();

        $this->layout->view('products/index_view', $data);
    }


    public function get_list(){

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->product->get_list($start, $limit);

        if($rs){

            $rows = json_encode($rs);
            //$total = $this->client->get_service_by_code_total();

            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }


    public function get_list_total(){

        $total = $this->product->get_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function get_model_list_by_brand(){
        $brand_code = $this->input->post('brand_code');
        $rs = $this->model->get_list_by_brand($brand_code);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';

        render_json($json);
    }

    public function search_list(){
        $query = $this->input->post('query');

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        if(empty($query)){
            $json = '{"success": false, "msg": "No query found."}';
        }else{
            $result = $this->product->search($query, $start, $limit);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function search_total(){
		$query = $this->input->post('query');
        $total = $this->product->search_total($query);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function search_filter(){
        $type_code = $this->input->post('type_code');
        $customer_code = $this->input->post('customer_code');

		$start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        if(empty($customer_code)){
            $json = '{"success": false, "msg": "No customer found."}';
        }else{
            $result = $this->product->search_filter($type_code, $customer_code, $start, $limit);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }


    public function search_filter_total(){
		$type_code = $this->input->post('type_code');
        $customer_code = $this->input->post('customer_code');

        $total = $this->product->search_filter_total($type_code, $customer_code);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }


    public function save(){


        $data = $this->input->post('data');

        if(empty($data)){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{

            if($data['isupdate'] == '1'){
                //do update
                $rs = $this->product->update($data);
                if($rs){
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "Database error, please check your data and try again."}';
                }
            }else{
                if(empty($data['code'])){
                    //generate serial
                    $data['code'] = generate_serial('PRODUCT');
                    //do save
                    $result = $this->product->save($data);

                    if($result){
                        $json = '{"success": true}';
                    }else{
                        $json = '{"success": false, "Database error, please check your data and try again."}';
                    }
                }else{
                    //check duplicate product code
                    $duplicated = $this->product->check_duplicate($data['code']);
                    if($duplicated){
                        $json = '{"success": false, "msg": "รายการนี้มีอยู่แล้วกรุณาตรวจสอบทะเบียนครุภัณฑ์"}';
                    }else{
                        //do save
                        $result = $this->product->save($data);

                        if($result){
                            $json = '{"success": true}';
                        }else{
                            $json = '{"success": false, "Database error, please check your data and try again."}';
                        }
                    }
                }
            }

        }

        render_json($json);
    }

    public function detail(){
        $product_code = $this->input->post('product_code');
        if(empty($product_code)){
            $json = '{"success": false, "msg": "No code defined."}';
        }else{
            $result = $this->product->detail($product_code);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }

    public function search_customer(){
        $query = $this->input->post('query');
        if(empty($query)){
            $json = '{"success": false, "msg": "No query defined."}';
        }else{
            $result = $this->product->search_customer($query);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }

    public function search_supplier(){
        $query = $this->input->post('query');
        if(empty($query)){
            $json = '{"success": false, "msg": "No query defined."}';
        }else{
            $result = $this->product->search_supplier($query);
            if($result){
                $rows = json_encode($result);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }

    public function remove(){
        $product_code = $this->input->post('product_code');
        if(empty($product_code)){
            $json = '{"success": false, "msg": "No Product code defined."}';
        }else{
            $result = $this->product->remove($product_code);
            if($result){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }

    public function get_detail()
    {
        $code = $this->input->post('code');
        if(empty($code))
        {
            $json = '{"success": false, "msg": "ไม่พบรายการ"}';
        }
        else
        {
            $rs = $this->product->get_detail($code);
            if($rs)
            {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบรายการ"}';
            }
        }

        render_json($json);
    }


}
