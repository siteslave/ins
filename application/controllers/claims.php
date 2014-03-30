<?php

class Claims extends CI_Controller{
	
	public $user_code;
    public $status;
	
	public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));


        $user_type = $this->session->userdata('user_type');
        
        if($user_type != '3') redirect(site_url('errors/access_denied'));
        
		$this->user_code = $this->session->userdata('user_code');
        
        $this->load->model('Product_model', 'product');
		$this->load->model('Claim_model', 'claim');
		$this->load->model('Service_model', 'service');
    }
	
	public function index(){
		$this->layout->view('claims/index_view');
	}
	
	public function search_service_ajax(){
		$query = $this->input->post('query');
		if(empty($query)){
			$json = '{"success": false, "msg": "No query found."}';
		}else{
			$rs = $this->claim->search_service_ajax($query);
			
			if($rs){
				$rows = json_encode($rs);
				$json = '{"success": true, "rows": '.$rows.'}';
			}else{
				$json = '{"success": false, "msg": "No result."}';
			}
		}
		
		render_json($json);
	}
	
	public function search_supplier_ajax(){
		$query = $this->input->post('query');
		if(empty($query)){
			$json = '{"success": false, "msg": "No query found."}';
		}else{
			$rs = $this->claim->search_supplier_ajax($query);
			
			if($rs){
                $arr_result = array();

                foreach($rs as $r)
                {
                    $obj = new stdClass();
                    $obj->name = $r->code . '#' . $r->name;

                    $arr_result[] = $obj;
                }
				$rows = json_encode($arr_result);
				$json = '{"success": true, "rows": '.$rows.'}';
			}else{
				$json = '{"success": false, "msg": "No result."}';
			}
		}
		
		render_json($json);
	}
	
	public function save(){
		$data = $this->input->post('data');

        $this->service->user_code = $this->user_code;
        $this->claim->user_code = $this->user_code;

        if($data['is_update'])
        {
            $rs = $this->claim->update($data);
            if($rs)
            {
                if($data['change_status'] == '1'){
                    $detail = '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม';
                    $this->service->save_activities($data['service_code'], $detail);
                    $this->service->change_service_status($data['service_code'], '6');
                }

                $json = '{"success": true}';
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่สามารถปรับปรุงรายการได้"}';
            }
        }
        else
        {
            //check claim exist
            $ready = $this->claim->check_ready($data['service_code']);
            if(!$ready){
                $json = '{"success": false, "msg": "รายการนี้ยังไม่มีการรับกลับคืน กรุณาตรวจสอบ"}';
            }else{
                $data['claim_code'] = generate_serial('CLAIM_SERVICE', TRUE);
                $data['claim_date'] = to_mysql_date($data['claim_date']);
                $rs = $this->claim->save($data);
                if($rs){
                    $detail = 'ส่งซ่อม -> ' . get_company_name($data['company_code']);
                    $this->service->save_activities($data['service_code'], $detail);

                    if($data['change_status'] == '1'){
                        $detail = '	เปลี่ยนสถานะซ่อม -> ส่งซ่อม';
                        $this->service->save_activities($data['service_code'], $detail);
                        $this->service->change_service_status($data['service_code'], '6');
                    }
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "msg": "Can\'t save service."}';
                }
            }
        }

		render_json($json);
	}

	public function get_list(){
		$start = $this->input->post('start');
        $stop = $this->input->post('stop');
        $status = $this->input->post('status');

        $this->status = empty($status) ? '0' : $status;

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;
		
		$rs = $this->claim->get_list($status, $limit, $start);
		if($rs){
			$rows = json_encode($rs);
			$json = '{"success": true, "rows": '. $rows .'}';
		}else{
			$json = '{"success": true, "rows": []}';
		}
		
		render_json($json);
	}
	
	public function get_list_total(){
		$status = $this->input->post('status');
		$status = empty($status) || isset($status) ? '-1' : $status;
		//-1 = all
		$rs = $this->claim->get_list_total($status);
		if($rs){
			$json = '{"success": true, "total": '. $rs .'}';
		}else{
			$json = '{"success": true, "total": 0}';
		}
		
		render_json($json);
	}
	
	public function search_total(){
		$query = $this->input->post('query');
		$rs = $this->claim->search_total($query);
		if($rs){
			$json = '{"success": true, "total": '. $rs .'}';
		}else{
			$json = '{"success": true, "total": 0}';
		}
		
		render_json($json);
	}
 	public function search(){
		$query = $this->input->post('query');
		$start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;
		
		if(empty($query)){
			$json = '{"success": false, "msg": "No query found."}';
		}else{
			$rs = $this->claim->search($query, $limit, $start);
			
			if($rs){
				$rows = json_encode($rs);
				$json = '{"success": true, "rows": '.$rows.'}';
			}else{
				$json = '{"success": false, "msg": "No result."}';
			}
		}
		
		render_json($json);
	}
	
	public function save_get(){
		$data = $this->input->post('data');
        $this->service->user_code = $this->user_code;
        $this->claim->user_code = $this->user_code;

		if(empty($data)){
			$json = '{"success": false, "msg": "No data for save."}';	
		}else{
			$rs = $this->claim->save_get($data);
			if($rs){

				$detail = 'รับกลับ -> ส่งซ่อม';
            	$this->service->save_activities($data['service_code'], $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t update data."}';
			}
		}
		
		render_json($json);
	}

	public function remove_get(){

		$data = $this->input->post('data');
        $this->service->user_code = $this->user_code;
        $this->claim->user_code = $this->user_code;

		if(empty($data)){

			$json = '{"success": false, "msg": "No data for save."}';

		}else{
			$rs = $this->claim->remove_get($data);

			if($rs){

				$detail = 'รับกลับ -> ลบข้อมูล';
            	$this->service->save_activities($data['service_code'], $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t remove data."}';
			}
		}
		
		render_json($json);
	}

	public function remove(){

		$id = $this->input->post('id');
		$service_code = $this->input->post('service_code');

        $this->service->user_code = $this->user_code;
        $this->claim->user_code = $this->user_code;

		if(empty($id)){

			$json = '{"success": false, "msg": "No id found."}';

		}else{
			$rs = $this->claim->remove($id);
			
			if($rs){

				$detail = 'รับกลับ -> ลบรายการ';
            	$this->service->save_activities($service_code, $detail);
				$json = '{"success": true}';
			}else{
				$json = '{"success": false, "msg": "Can\t remove data."}';
			}
		}
		
		render_json($json);
	}
}
