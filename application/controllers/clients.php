<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class clients extends CI_Controller
{

    public $user_code;

    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('client_layout');

        $client_name = $this->session->userdata('client_name');
        $this->user_code = $this->session->userdata('user_code');

        if(empty($client_name)) redirect(site_url('users/login'));

        $this->load->model('Client_model', 'client');
        $this->load->model('Basic_model', 'basic');
        $this->load->model('Service_model', 'service');
        $this->load->model('User_model', 'user');

        $this->client->user_code = $this->user_code;
    }

    public function index()
    {
        $data['priority'] = $this->basic->get_priority_list();
        $this->layout->view('clients/index_view', $data);
    }

    public function search_service_history()
    {
        $service_code = $this->input->post('service_code');
        if(!empty($service_code))
        {
            $rs = $this->client->search_service_history($service_code);
            if($rs)
            {
                $arr_result = array();
                foreach($rs as $r)
                {
                    $obj = new stdClass();
                    $obj->date_serv = to_thai_date($r->date_serv);
                    $obj->service_code = $r->service_code;
                    $obj->product_code = $r->product_code;
                    $obj->customer_name = $r->customer_name;
                    $obj->technician_name = $r->technician_name;
                    $obj->contact_name = $r->contact_name;
                    $obj->service_result = $r->service_result;
                    $obj->service_status = get_status_name($r->service_status);
                    $obj->cause = $r->cause;
                    $obj->brand_name = $r->brand_name;
                    $obj->model_name = $r->model_name;
                    $obj->type_name = $r->type_name;
                    $obj->service_result = $r->service_result;
                    $obj->discharge_date = to_thai_date($r->discharge_date);

                    $arr_result[] = $obj;
                }

                $rows = json_encode($arr_result);

                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
            }

        }
        else
        {
            $json = '{"success": false, "msg": "กรุณาระบุคำค้นหา"}';
        }

        render_json($json);
    }

    public function info($service_code=""){
        if(empty($service_code) || !isset($service_code)){
            show_error('No service found.', 404);
        }else{
            $exist = $this->service->service_exist($service_code);

            if($exist){
                $rs = $this->client->get_info($service_code);
                $data['service_code'] = $rs->service_code;
                $data['date_serv'] = to_thai_date($rs->date_serv);
                $data['product_code'] = $rs->product_code;
                $data['brand_name'] = $rs->brand_name;
                $data['type_name'] = $rs->type_name;
                $data['model_name'] = $rs->model_name;
                $data['status_name'] = get_status_name($rs->service_status);
                $data['technician_name'] = $rs->technician_name;
                $data['contact_name'] = $rs->contact_name;
                $data['contact_telephone'] = $rs->contact_telephone;
                $data['customer_name'] = $rs->customer_name;
                $data['cause'] = $rs->cause;
                $data['service_result'] = $rs->service_result;
                $data['discharge_date'] = to_thai_date($rs->discharge_date);
                $data['other_device'] = $this->service->get_other_device($rs->service_code);
                $data['charge_items'] = $this->service->get_charge_item($rs->service_code);
                $data['activities'] = $this->service->get_activities($rs->service_code);

                $this->layout->view('clients/service_info_view', $data);
            }else{
                show_error('No service.', 404);
            }
        }
    }

    public function get_activities(){
        $service_code = $this->input->post('service_code');
        if(empty($service_code)){
            $json = '{"success": false, "msg": "No service code found."}';
        }else{
            $rs = $this->service->get_activities($service_code);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }
    public function get_items(){
        $service_code = $this->input->post('$service_code');
        if(empty($service_code)){
            $json = '{"success": false, "msg": "No service code found."}';
        }else{
            $rs = $this->service->get_item($service_code);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function search_service_ajax(){
        $query = $this->input->post('query');
        if(empty($query)){
            $json = '{"success": false, "msg": "No query found."}';
        }else{
            $rs = $this->client->search_service_ajax($query);

            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }

    public function change_password(){
        $username = $this->session->userdata('client_name');
        $new_pass = $this->input->post('new_pass');
        $old_pass = $this->input->post('old_pass');

        if(empty($new_pass) || empty($old_pass)){
            $json = '{"success": false, "msg": "กรุณาระบุรหัสผ่านให้ครบ"}';
        }else{
            //check old password
            $chk = $this->user->do_login($username, $old_pass);
            if($chk)
            {
                $rs = $this->user->change_password($username, $new_pass);
                if($rs){
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "msg": "Can\'t change password."}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "รหัสผ่านเดิมไม่ถูกต้อง กรุณาตรวจสอบ"}';
            }

        }
        
        render_json($json);
    }

    public function save_request()
    {
        $data = $this->input->post('data');
        if(empty($data))
        {
            $json = '{"success": false, "msg": "กรุณาระบุข้อมูลที่ต้องการบันทึก"}';
        }
        else
        {
            $data['code'] = generate_serial('REQUEST');
            $data['user_code'] = $this->user_code;

            $rs = $this->client->save_request($data);

            if($rs)
            {
                $json = '{"success": true }';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่สามารถบันทึกรายการได้"}';
            }
        }

        render_json($json);
    }


    public function get_request_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $result = $this->client->get_request_list($start, $limit);
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function search_request(){
        $query = $this->input->post('query');

        $result = $this->client->get_request_list_search($query);
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_request_total(){

        $total = $this->client->get_request_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function cancel_request()
    {
        $id = $this->input->post('id');
        if(empty($id))
        {
            $json = '{"success": false, "msg": "กรุณาระบุรหัส"}';
        }
        else
        {
            //check status
            $chk = $this->client->request_status_ok($id);
            if($chk)
            {
                $rs = $this->client->cancel_request($id);
                if($rs)
                {
                    $json = '{"success": true }';
                }
                else
                {
                    $json = '{"success": false, "msg": "ไม่สามารถยกเลิกรายการได้"}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "รายการนี้ได้รับการยืนยันแล้วไม่สามารถยกเลิกได้"}';
            }

        }

        render_json($json);
    }

    public function get_request_status_total(){

        $status = $this->input->post('status');
        $total = $this->client->get_request_status_total($status);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function get_request_status_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $status = $this->input->post('status');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $result = $this->client->get_request_status_list($status, $start, $limit);
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
}
