<?php

class Reports extends CI_Controller {
    
    var $user_id;
    
    public function __construct(){
        
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $this->user_id = $this->session->userdata('user_id');

        $this->load->model('Report_model', 'report');
        $this->load->model('Service_model', 'service');
        
    }

    public function index()
    {
        $this->layout->view('reports/index_view');
    }

    public function get_total(){

        $users = $this->report->get_user_list();
        
        $arr_result = array();
        
        foreach($users as $r){
            $obj = new stdClass();
            $obj->user_code = $r->user_code;
            $obj->fullname = $r->fullname;
            $obj->total = $this->report->get_total($r->user_code);
            
            $arr_result[] = $obj;
        }
        
        $rows = json_encode($arr_result);
        
        $json = '{"success": true, "rows": '. $rows .'}';
        
        render_json($json);
    }
    public function get_total_by_date(){
        $s = $this->input->post('s');
        $e = $this->input->post('e');


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $users = $this->report->get_user_list();

        $arr_result = array();

        foreach($users as $r){
            $obj = new stdClass();
            $obj->user_code = $r->user_code;
            $obj->fullname = $r->fullname;
            $obj->total = $this->report->get_total_by_date($r->user_code, $s, $e);

            $arr_result[] = $obj;
        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);

    }

    public function get_status_total(){

        $status = get_status_list();

        $arr_result = array();

        foreach($status as $k=>$v)
        {
            $obj = new stdClass();
            $obj->status_name = $v;
            $obj->total = $this->report->get_status_total($k);

            $arr_result[] = $obj;
        }

        $rows = json_encode($arr_result);
        
        $json = '{"success": true, "rows": '. $rows .'}';
        
        render_json($json);
    }
    public function get_status_total_by_date(){
        
        $s = $this->input->post('s');
        $e = $this->input->post('e');
        
        
        date_default_timezone_set('Asia/Bangkok');
        
        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $status = get_status_list();

        $arr_result = array();

        foreach($status as $k=>$v)
        {
            $obj = new stdClass();
            $obj->status_name = $v;
            $obj->total = $this->report->get_status_total_by_date($k, $s, $e);

            $arr_result[] = $obj;
        }

        $rows = json_encode($arr_result);
        
        $json = '{"success": true, "rows": '. $rows .'}';
        
        render_json($json);
    }

    public function get_total_by_customer(){
        $rs = $this->report->get_total_by_customer();

        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }

    public function get_total_by_product(){
        $rs = $this->report->get_total_by_product();

        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }

    public function get_total_by_customer_date(){

        $s = $this->input->post('s');
        $e = $this->input->post('e');


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $rs = $this->report->get_total_by_customer_date($s, $e);

        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }
    public function get_total_by_product_date(){

        $s = $this->input->post('s');
        $e = $this->input->post('e');


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $rs = $this->report->get_total_by_product_date($s, $e);

        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);
    }

    public function history()
    {
        $this->layout->view('reports/history_view');
    }
    public function search_history()
    {
        $query = $this->input->post('query');
        if(!empty($query))
        {
            $rs = $this->report->search_history($query);
            if($rs)
            {
                $arr_result = array();
                foreach($rs as $r)
                {
                    $obj = new stdClass();
                    $obj->date_serv = to_thai_date($r->date_serv);
                    $obj->service_code = $r->service_code;
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
                    $obj->discharge_date = $r->discharge_date;

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
    //report index
    public function get_total_success_by_date(){
        $s = $this->input->post('s');
        $e = $this->input->post('e');


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $users = $this->report->get_user_list();

        $arr_result = array();

        foreach($users as $r){
            $obj = new stdClass();
            $obj->user_code = $r->user_code;
            $obj->fullname = $r->fullname;
            $obj->success = $this->report->get_total_success_by_date($r->user_code, $s, $e);
            $obj->not_success = $this->report->get_total_not_success_by_date($r->user_code, $s, $e);

            $arr_result[] = $obj;
        }

        $rows = json_encode($arr_result);

        $json = '{"success": true, "rows": '. $rows .'}';

        render_json($json);

    }

    public function get_list_by_date()
    {
        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $rs = $this->report->get_list_by_date($s, $e, $start, $limit);

        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->type_name = $r->type_name;
                $obj->brand_name = $r->brand_name;
                $obj->model_name = $r->model_name;
                $obj->service_code = $r->service_code;
                $obj->service_code = $r->service_code;
                $obj->customer_name = $r->customer_name;
                $obj->technician_name = $r->technician_name;
                $obj->contact_name = $r->contact_name;
                $obj->service_result = $r->service_result;
                $obj->service_status = get_status_name($r->service_status);
                $obj->discharge_status = $r->discharge_status;
                $obj->cause = $r->cause;

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);

            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
        }

        render_json($json);
    }

    public function get_list_by_date_total()
    {

        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $total = $this->report->get_list_by_date_total($s, $e);

        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function get_service_by_technician()
    {
        $s = $this->input->post('s');
        $e = $this->input->post('e');
        $user_code = $this->input->post('user_code');

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $rs = $this->report->get_service_by_technician($user_code, $s, $e, $start, $limit);

        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->type_name = $r->type_name;
                $obj->brand_name = $r->brand_name;
                $obj->model_name = $r->model_name;
                $obj->service_code = $r->service_code;
                $obj->service_code = $r->service_code;
                $obj->customer_name = $r->customer_name;
                $obj->technician_name = $r->technician_name;
                $obj->contact_name = $r->contact_name;
                $obj->service_result = $r->service_result;
                $obj->service_status = get_status_name($r->service_status);
                $obj->discharge_status = $r->discharge_status;
                $obj->cause = $r->cause;

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);

            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
        }

        render_json($json);
    }
    public function get_service_by_customer()
    {
        $s = $this->input->post('s');
        $e = $this->input->post('e');
        $customer_code = $this->input->post('customer_code');

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;


        date_default_timezone_set('Asia/Bangkok');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $rs = $this->report->get_service_by_customer($customer_code, $s, $e, $start, $limit);

        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->type_name = $r->type_name;
                $obj->brand_name = $r->brand_name;
                $obj->model_name = $r->model_name;
                $obj->service_code = $r->service_code;
                $obj->service_code = $r->service_code;
                $obj->customer_name = $r->customer_name;
                $obj->technician_name = $r->technician_name;
                $obj->contact_name = $r->contact_name;
                $obj->service_result = $r->service_result;
                $obj->service_status = get_status_name($r->service_status);
                $obj->discharge_status = $r->discharge_status;
                $obj->cause = $r->cause;

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);

            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
        }

        render_json($json);
    }

    public function get_service_by_technician_total()
    {

        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $user_code = $this->input->post('user_code');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $total = $this->report->get_service_by_technician_total($user_code, $s, $e);

        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }
    public function get_service_by_customer_total()
    {

        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $customer_code = $this->input->post('customer_code');

        $s = empty($s) ? date('Y-m-d') : to_mysql_date($s);
        $e = empty($e) ? date('Y-m-d') : to_mysql_date($e);

        $total = $this->report->get_service_by_customer_total($customer_code, $s, $e);

        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

}
