<?php
class Send_model extends CI_Model{

    public $user_code;

	public function search_service_ajax($query){
		$rs = $this->db
				->select(array('s.service_code'))
				->like('s.service_code', $query)
				->limit(20)
				->get('services s')->result();
		return $rs;
	}
	
	public function search_supplier_ajax($query){
		$rs = $this->db
			->like('name', $query)
            ->or_like('code', $query)
			->limit(20)
			->get('suppliers')
			->result();
		return $rs;
	}

	public function save($data){
		$rs = $this->db
			->set('service_code', $data['service_code'])
			->set('send_code', $data['send_code'])
			->set('send_date', $data['send_date'])
			->set('company_code', $data['company_code'])
			->set('user_code', $this->user_code)
			->insert('send_services');
		return $rs;
	}
	
	public function check_ready($sv){
		$rs = $this->db
				->where('service_code', $sv)
				->where('send_status', '0')
				->count_all_results('send_services');
		return $rs > 0 ? FALSE : TRUE;
	}


	public function get_list($status, $limit, $start){
		if($status == '-1'){
			$rs = $this->db
				->select(array(
					'ss.*', 's.date_serv', 'c.name as company_name',
					'p.code as product_code', 't.name as type_name',
					'u.fullname as user_name', 'b.name as brand_name',
                    'm.name as model_name'
				))
				->join('suppliers c', 'c.code=ss.company_code', 'left')
				->join('services s', 's.service_code=ss.service_code')
				->join('users u', 'u.user_code=ss.user_code', 'left')
                ->join('products p', 'p.code=s.product_code', 'left')
                ->join('product_types t', 't.code=p.type_code', 'left')
                ->join('product_brands b', 'b.code=p.brand_code', 'left')
                ->join('product_models m', 'm.code=p.model_code', 'left')
				->order_by('ss.send_date')
				->limit($limit, $start)
				->get('send_services ss')
				->result();
		}else{
			$rs = $this->db
				->select(array(
                    'ss.*', 's.date_serv', 'c.name as company_name',
                    'p.code as product_code', 't.name as type_name',
                    'u.fullname as user_name', 'b.name as brand_name',
                    'm.name as model_name'
				))
                ->join('suppliers c', 'c.code=ss.company_code', 'left')
                ->join('services s', 's.service_code=ss.service_code')
                ->join('users u', 'u.user_code=ss.user_code', 'left')
                ->join('products p', 'p.code=s.product_code', 'left')
                ->join('product_types t', 't.code=p.type_code', 'left')
                ->join('product_brands b', 'b.code=p.brand_code', 'left')
                ->join('product_models m', 'm.code=p.model_code', 'left')

				->where('ss.send_status', $status)
				->order_by('ss.send_date')
				->limit($limit, $start)
				->get('send_services ss')
				->result();
		}
		return $rs;
	}
	
	public function get_list_total($status){
		if($status == '-1'){
			$rs = $this->db
				->count_all_results('send_services');
		}else{
			$rs = $this->db
				->where('send_status', $status)
				->count_all_results('send_services');
		}
		
		return $rs;
	}
	
	public function search($query, $limit, $start){
		$rs = $this->db
            ->select(array(
                    'ss.*', 's.date_serv', 'c.name as company_name',
                    'p.code as product_code', 't.name as type_name',
                    'u.fullname as user_name', 'b.name as brand_name',
                    'm.name as model_name'
                ))
                ->join('suppliers c', 'c.code=ss.company_code', 'left')
                ->join('services s', 's.service_code=ss.service_code')
                ->join('users u', 'u.user_code=ss.user_code', 'left')
                ->join('products p', 'p.code=s.product_code', 'left')
                ->join('product_types t', 't.code=p.type_code', 'left')
                ->join('product_brands b', 'b.code=p.brand_code', 'left')
                ->join('product_models m', 'm.code=p.model_code', 'left')
				->where('ss.send_code', $query)
				->or_where('ss.service_code', $query)
				->order_by('ss.send_date')
				->limit($limit, $start)
				->get('send_services ss')
				->result();
				
		return $rs;
	}

	
	public function search_total($query){
		$rs = $this->db
				->where('s.send_code', $query)
				->or_where('s.service_code', $query)
				->order_by('s.send_date')
				->count_all_results('send_services s');
				
		return $rs;
	}
	
	public function update($data){
		$rs = $this->db
				->where('id', $data['id'])
				->set('company_code', $data['company_code'])
				->set('send_date', to_mysql_date($data['send_date']))
				->update('send_services');
		return $rs;
	}

	public function save_get($data){
		$rs = $this->db
				->where('id', $data['id'])
				->set('get_date', to_mysql_date($data['get_date']))
				->set('get_user_code', $this->user_code)
				->set('send_status', '1')
				->update('send_services');
				
		return $rs;
	}

	public function remove_get($data){

		date_default_timezone_set('Asia/Bangkok');

		$rs = $this->db
				->where('id', $data['id'])
				->set('get_date', NULL)
				->set('get_user_code', NULL)
				->set('send_status', '0')
				->update('send_services');

		return $rs;
	}

	public function remove($id){
		$rs = $this->db->where('id', $id)->delete('send_services');
		return $rs;
	}
}
