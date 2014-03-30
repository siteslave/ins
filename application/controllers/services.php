<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller
{
    public $status;
    public $user_code;
    public $customer_code;
    public $technician_code;

    public function __construct()
    {
        parent::__construct();
        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $this->user_code = $this->session->userdata('user_code');

        $this->load->model('Service_model', 'service');
        $this->load->model('User_model', 'user');
        $this->load->model('Product_model', 'product');
        $this->load->model('Item_model', 'item');
        $this->load->model('Customer_model', 'customer');
    }

    public function index()
    {
        $data['customers'] = $this->customer->get_all();
        $this->layout->view('services/index_view', $data);
    }

    public function save_register()
    {
        $is_ajax = $this->input->is_ajax_request();
        if($is_ajax)
        {
            $data = $this->input->post('data');
            if(empty($data))
            {
                $json = '{"success": false, "msg": "ไม่พบข้อมูลที่ต้องการบันทึก"}';
            }
            else
            {
                if($data['isupdate'] == '1')
                {
                    //check auth
                    $auth = $this->user->check_privileges($data['user_code'], $data['password']);
                    if($auth)
                    {
                        $data['date_serv'] = to_mysql_date($data['date_serv']);

                        $rs = $this->service->update_register($data);

                        if($rs)
                        {
                            $this->service->user_code = $data['user_code'];
                            $detail = 'แก้ไขข้อมูลการลงทะเบียน';
                            $this->service->save_activities($data['service_code'], $detail);

                            $this->service->remove_all_other_device($data['service_code']);

                            if(isset($data['items']))
                            {
                                //save other device
                                if(count($data['items']))
                                {
                                    foreach($data['items'] as $t)
                                    {
                                        $this->service->save_other_device($data['service_code'], $t['code'], $t['qty']);
                                    }
                                }
                            }

                            $json = '{"success": true}';
                        }
                        else
                        {
                            $json = '{"success": false, "msg": "ไม่สามารถบันทึกข้อมูลได้"}';
                        }
                    }
                    else
                    {
                        $json = '{"success": false, "msg": "ชื่อผู้ใช้งาน/รหัสผ่าน ไม่ถูกต้องกรุณาตรวจสอบ"}';
                    }
                }
                else
                {
                    //check product discharged
                    $discharge_status = $this->service->check_product_discharged($data['product_code']);
                    if($discharge_status)
                    {
                        //check auth
                        $auth = $this->user->check_privileges($data['user_code'], $data['password']);
                        if($auth)
                        {
                            $this->service->user_code = $data['user_code'];
                            //serial
                            $data['service_code'] = generate_serial('SERVICE');
                            $data['date_serv'] = to_mysql_date($data['date_serv']);

                            $rs = $this->service->save_register($data);
                            if($rs)
                            {
                                $this->service->user_code = $data['user_code'];
                                $detail = 'ลงทะเบียนรับซ่อม';
                                $this->service->save_activities($data['service_code'], $detail);
                                //save other device
                                if(count($data['items']))
                                {
                                    foreach($data['items'] as $t)
                                    {
                                        $this->service->save_other_device($data['service_code'], $t['code'], $t['qty']);
                                    }
                                }

                                $json = '{"success": true}';
                            }
                            else
                            {
                                $json = '{"success": false, "msg": "ไม่สามารถบันทึกข้อมูลได้"}';
                            }
                        }
                        else
                        {
                            $json = '{"success": false, "msg": "ชื่อผู้ใช้งาน/รหัสผ่าน ไม่ถูกต้องกรุณาตรวจสอบ"}';
                        }

                    }
                    else
                    {
                        $json = '{"success": false, "msg": "รายการนี้ยังไม่ถูกจำหน่ายไม่สามารถลงทะเบียนรับซ่อมได้ กรุณาตรวจสอบ."}';
                    }
                }
            }

            render_json($json);
        }
        else
        {
            show_error('Not ajax.', 404);
        }
    }

    public function search_product_ajax($query='')
    {
        $is_ajax = $this->input->is_ajax_request();
        if($is_ajax)
        {
            $rs = $this->product->search_ajax($query);
            if($rs)
            {
                $arr_result = array();
                foreach($rs as $r)
                {
                    $obj = new stdClass();
                    $obj->name = $r->product_code .'#' . $r->type_name . ' ยี่ห้อ: ' . $r->brand_name . ' รุ่น: ' . $r->model_name;
                    $arr_result[] = $obj;
                }

                $rows = json_encode($arr_result);

                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false ,"msg": "No data."}';
            }

            render_json($json);
        }
        else
        {
            show_error('Not ajax', 404);
        }
    }
    public function search_charge_item_ajax($query='')
    {
        $is_ajax = $this->input->is_ajax_request();
        if($is_ajax)
        {
            $rs = $this->item->search($query);
            if($rs)
            {
                $arr_result = array();
                foreach($rs as $r)
                {
                    $obj = new stdClass();
                    $obj->name = $r->code .'#' . $r->name . '#' . $r->price;
                    $arr_result[] = $obj;
                }

                $rows = json_encode($arr_result);

                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false ,"msg": "No data."}';
            }

            render_json($json);
        }
        else
        {
            show_error('Not ajax', 404);
        }
    }

    public function get_service_list(){
        $this->service->status = $this->status;

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $status = $this->input->post('status');
        $customer = $this->input->post('c');
        $technician = $this->input->post('t');

        $this->status = empty($status) ? '1' : $status;
        $this->customer_code = empty($customer) ? FALSE : $customer;
        $this->technician_code = empty($technician) ? FALSE : $technician;

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $this->service->status = $this->status;
        $this->service->customer_code = $this->customer_code;
        $this->service->technician_code = $this->technician_code;

        $rs = $this->service->get_service_list($start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->id = $r->id;
                $obj->service_code = $r->service_code;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->type_name = $r->type_name;
                $obj->brand_name = $r->brand_name;
                $obj->model_name = $r->model_name;
                $obj->cause = $r->cause;
                $obj->customer_name = $r->customer_name;
                $obj->status = get_status_name($r->service_status);
                $obj->service_status = $r->service_status;
                $obj->technician_code = empty($r->technician_code) ? '' : $r->technician_code;
                $obj->technician_name = empty($r->technician_name) ? '-' : $r->technician_name;

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_service_total(){

        $status = $this->input->post('status');
        $customer = $this->input->post('c');
        $technician = $this->input->post('t');

        $this->customer_code = empty($customer) ? FALSE : $customer;
        $this->technician_code = empty($technician) ? FALSE : $technician;
        $this->status = empty($status) ? '1' : $status;

        $this->service->status = $this->status;
        $this->service->customer_code = $this->customer_code;
        $this->service->technician_code = $this->technician_code;

        $total = $this->service->get_service_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }
    public function search_service(){
        $service_code = $this->input->post('service_code');

        $rs = $this->service->search_service($service_code);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->id = $r->id;
                $obj->service_code = $r->service_code;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->type_name = $r->type_name;
                $obj->brand_name = $r->brand_name;
                $obj->model_name = $r->model_name;
                $obj->cause = $r->cause;
                $obj->customer_name = $r->customer_name;
                $obj->status = get_status_name($r->service_status);
                $obj->service_status = $r->service_status;
                $obj->technician_code = empty($r->technician_code) ? '' : $r->technician_code;
                $obj->technician_name = empty($r->technician_name) ? '-' : $r->technician_name;

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_service_list_date(){
        $this->service->status = $this->status;

        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $status = $this->input->post('status');
        $date_serv = $this->input->post('date_serv');

        $date_serv = empty($date_serv) ? date('Y-m-d') : to_mysql_date($date_serv);

        $this->status = empty($status) ? '1' : $status;

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $this->service->status = $this->status;
        $rs = $this->service->get_service_list_date($date_serv, $start, $limit);

        if($rs){
            $arr_result = array();
            foreach ($rs as $r) {
                $obj = new stdClass();
                $obj->id = $r->id;
                $obj->service_code = $r->service_code;
                $obj->date_serv = to_thai_date($r->date_serv);
                $obj->product_code = $r->product_code;
                $obj->type_name = $r->type_name;
                $obj->brand_name = $r->brand_name;
                $obj->model_name = $r->model_name;
                $obj->cause = $r->cause;
                $obj->customer_name = $r->customer_name;
                $obj->status = get_status_name($r->service_status);
                $obj->service_status = $r->service_status;
                $obj->technician_code = empty($r->technician_code) ? '' : $r->technician_code;
                $obj->technician_name = empty($r->technician_name) ? '-' : $r->technician_name;

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';

        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }

    public function get_service_total_date(){

        $status = $this->input->post('status');
        $date_serv = $this->input->post('date_serv');
        $date_serv = empty($date_serv) ? date('Y-m-d') : to_mysql_date($date_serv);

        $this->status = empty($status) ? '1' : $status;

        $this->service->status = $this->status;
        $total = $this->service->get_service_total_date($date_serv);
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }

    public function save_assign_tech(){
        $data = $this->input->post('data');

        if(empty($data)){
            $json = '{"success": false, "msg": "No service code found."}';
        }else{
/*            //check assigned
            $assigned = $this->service->check_technician_status($data['service_code']);
            if(!$assigned)
            {
                $json = '{"success": false, "msg": "มีการกำหนดช่างผู้รับผิดชอบแล้ว ไม่สามารถเพิ่มได้อีก กรุณาติดต่อผู้ดูแลระบบ"}';
            }
            else
            {
                //authen

            }*/

            $auth = $this->user->check_privileges($data['admin_code'], $data['password']);

            if($auth)
            {
                $rs = $this->service->save_assign_tech($data);
                if($rs){
                    $this->service->user_code = $data['user_code'];
                    $detail =  $this->session->userdata('fullname') . ' กำหนดช่าง -> ' . get_user_fullname($data['user_code']);
                    $this->service->save_activities($data['service_code'], $detail);
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "msg": "Can\'t assign technician, please check your data and try again."}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ข้อมูลผู้ใช้/รหัสผ่านไม่ถูกต้อง"}';
            }
        }

        render_json($json);
    }

    public function save_change_status(){
        $data = $this->input->post('data');

        if(empty($data)){
            $json = '{"success": false, "msg": "No data found."}';
        }else{
            //check assigned
            $assigned = $this->service->check_technician_status($data['service_code']);
            if($assigned)
            {
                $json = '{"success": false, "msg": "กรุณากำหนดช่างผู้รับผิดชอบก่อนทำการเปลี่ยนสถานะ"}';
            }
            else
            {
                //check owner
                $is_owner = $this->service->check_technician_owner($data['user_code'], $data['service_code']);
                if($is_owner)
                {
                    //authen
                    $auth = $this->user->check_privileges($data['user_code'], $data['password']);

                    if($auth)
                    {
                        $rs = $this->service->save_change_status($data);
                        if($rs){
                            $this->service->user_code = $data['user_code'];
                            $detail = 'เปลี่ยนสถานะ -> ' . get_status_name($data['status']);
                            $this->service->save_activities($data['service_code'], $detail);
                            $json = '{"success": true}';
                        }else{
                            $json = '{"success": false, "msg": "Can\'t assign technician, please check your data and try again."}';
                        }
                    }
                    else
                    {
                        $json = '{"success": false, "msg": "ข้อมูลผู้ใช้/รหัสผ่านไม่ถูกต้อง"}';
                    }
                }
                else
                {
                    $json = '{"success": false, "msg": "รายการนี้ไม่ใช่ของคุณ คุณไม่มีสิทธิ์เปลี่ยนสถานะ กรุณาติดต่อผู้ดูแลระบบ"}';
                }
            }
        }

        render_json($json);
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

    public function save_charge_items(){
        $data = $this->input->post('data');
        if(empty($data))
        {
            $json = '{"success": false, "msg": "No data for save."}';
        }
        else
        {
            $auth = $this->user->check_privileges($data['user_code'], $data['password']);
            if($auth)
            {
                $rs = $this->service->remove_charge_item($data['service_code']);

                if($rs)
                {
                    if(isset($data['items']))
                    {
                        foreach($data['items'] as $t)
                        {
                            $this->service->save_charge_item($data['service_code'],
                                $t['code'], $t['qty'], $t['price']);
                        }
                    }
                    $json = '{"success": true}';
                }
                else
                {
                    $json = '{"success": false, "msg": "ไม่สามารถลบรายการเดิมได้ กรุณาตรวจสอบ"}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ชื่อผู้ใช้งาน/รหัสผ่าน ไม่ถูกต้อง"}';
            }
        }

        render_json($json);
    }

    public function get_charge_items(){
        $service_code = $this->input->post('service_code');
        if(empty($service_code)){
            $json = '{"success": false, "msg": "No service code found."}';
        }else{
            $rs = $this->service->get_charge_item($service_code);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No result."}';
            }
        }

        render_json($json);
    }
    public function save_activities(){
        $data = $this->input->post('data');
        
        if(empty($data)){
            $json = '{"success": false, "msg": "No data found."}';
        }else{

            $auth = $this->user->check_privileges($data['user_code'], $data['password']);
            if($auth)
            {
                $this->service->user_code = $data['user_code'];
                $rs = $this->service->save_activities($data['service_code'], $data['result']);

                if($rs){
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "msg": "Can\'t save result."}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ชื่อผู้ใช้งาน/รหัสผ่าน ไม่ถูกต้อง"}';
            }
        }
        
        render_json($json);
    }

    public function save_result()
    {
        $data = $this->input->post('data');

        if(empty($data))
        {
            $json = '{"success": false, "msg": "No data found."}';
        }
        else
        {
            $auth = $this->user->check_privileges($data['user_code'], $data['password']);
            if($auth)
            {
                $rs = $this->service->save_result($data);
                if($rs)
                {
                    $this->service->user_code = $data['user_code'];
                    $detail = 'จำหน่ายรายการ --> วันที่จำหน่าย ' . js_to_thai_date($data['discharge_date']);
                    $this->service->save_activities($data['service_code'], $detail);
                    $json = '{"success": true}';
                }
                else
                {
                    $json = '{"success": false, "msg": "Can\'t save result."}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ชื่อผู้ใช้งาน/รหัสผ่าน ไม่ถูกต้อง"}';
            }
        }

        render_json($json);
    }
    
    public function get_result(){

        $service_code = $this->input->post('service_code');

        if(empty($service_code)){
            $json = '{"success": false, "msg": "No service code found."}';
        }else{

            $rs = $this->service->get_result($service_code);

            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No service result."}';
            }
        }
        
        render_json($json);
    }

	public function remove_service_code(){
		$service_code = $this->input->post('sv');
		if(empty($service_code)){
			$json = '{"success": false, "msg": "No service code found."}';
		}else{
			$user_type = $this->session->userdata('user_type');
			if($user_type == '3'){
				$rs = $this->service->remove_service_code($service_code);
				if($rs){
					$json = '{"success": true}';
				}else{
					$json = '{"success": false, "msg": "Can\'t remove service."}';
				}
			}else{
				$json = '{"success": false, "msg": "Permission denied."}';
			}
		}
		
		render_json($json);
	}

	public function get_detail()
    {
        $service_code = $this->input->post('service_code');
        if( ! empty($service_code))
        {
            $rs = $this->service->get_detail($service_code);
            if($rs)
            {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
               $json = '{"success": false, "msg": "ไม่สามารถดึงข้อมูลได้"}';
            }
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบเลขที่รับซ่อม"}';
        }

        render_json($json);
    }

    public function get_other_device()
    {
        $service_code = $this->input->post('service_code');
        if( ! empty($service_code) )
        {
            $rs = $this->service->get_other_device($service_code);
            if($rs)
            {
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่สามารถดึงข้อมูลได้"}';
            }
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบเลขที่รับซ่อม"}';
        }

        render_json($json);
    }

    public function request()
    {
        $this->layout->view('services/request_view');
    }

    public function get_request_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $result = $this->service->get_request_list($start, $limit);
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_request_status_list(){
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $status = $this->input->post('status');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $result = $this->service->get_request_status_list($status, $start, $limit);
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

        $result = $this->service->get_request_list_search($query);
        if($result){
            $rows = json_encode($result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "No result."}';
        }

        render_json($json);
    }
    public function get_request_total(){

        $total = $this->service->get_request_total();
        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }
    public function get_request_status_total(){

        $status = $this->input->post('status');
        $total = $this->service->get_request_status_total($status);
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
            $rs = $this->service->cancel_request($id);
            if($rs)
            {
                $json = '{"success": true }';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่สามารถยกเลิกรายการได้"}';
            }

        }

        render_json($json);
    }
    public function confirm_request()
    {
        $id = $this->input->post('id');
        if(empty($id))
        {
            $json = '{"success": false, "msg": "กรุณาระบุรหัส"}';
        }
        else
        {
            $rs = $this->service->confirm_request($id);
            if($rs)
            {
                $json = '{"success": true }';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่สามารถยกเลิกรายการได้"}';
            }

        }

        render_json($json);
    }
}
