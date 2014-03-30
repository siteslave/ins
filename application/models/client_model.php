<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model
{
    public $user_code;

    public function search_service_history($service_code)
    {
        $rs = $this->db
            ->select(array(
                'p.code as product_code', 'p.id as product_id',
                'p.product_serial', 'p.purchase_date', 'c.name as customer_name',
                'b.name as brand_name', 'm.name as model_name', 't.name as type_name',
                's.*', 'u.fullname as technician_name'
            ))
            ->join('products p', 'p.code=s.product_code', 'left')
            ->join('product_brands b', 'b.code=p.brand_code', 'left')
            ->join('product_models m', 'm.code=p.model_code', 'left')
            ->join('product_types t', 't.code=p.type_code', 'left')
            ->join('customers c', 'c.code=p.customer_code', 'left')
            ->join('users u', 'u.user_code=s.technician_code', 'left')
            ->where(array('s.service_code' => $service_code))
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }

    public function get_info($service_code)
    {
        $rs = $this->db
            ->select(array(
                'p.code as product_code', 'p.id as product_id',
                'p.product_serial', 'p.purchase_date', 'c.name as customer_name',
                'b.name as brand_name', 'm.name as model_name', 't.name as type_name',
                's.*', 'u.fullname as technician_name'
            ))
            ->join('products p', 'p.code=s.product_code', 'left')
            ->join('product_brands b', 'b.code=p.brand_code', 'left')
            ->join('product_models m', 'm.code=p.model_code', 'left')
            ->join('product_types t', 't.code=p.type_code', 'left')
            ->join('customers c', 'c.code=p.customer_code', 'left')
            ->join('users u', 'u.user_code=s.technician_code', 'left')
            ->where(array('s.service_code' => $service_code))
            ->limit(1)
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->row();
        return $rs;
    }
    public function search_service_ajax($query){
        $rs = $this->db
            ->select(array('s.service_code'))
            ->like('s.service_code', $query)
            ->limit(20)
            ->get('services s')->result();
        return $rs;
    }

    public function save_request($data)
    {
        $rs = $this->db
            ->set('customer', $data['customer'])
            ->set('contact', $data['contact'])
            ->set('telephone', $data['telephone'])
            ->set('detail', $data['detail'])
            ->set('status_code', '0')
            ->set('user_code', $data['user_code'])
            ->set('code', $data['code'])
            ->set('req_date', date('Y-m-d'))
            ->insert('service_requests');
        return $rs;
    }

    public function cancel_request($data)
    {
        $rs = $this->db
            ->where(array('id' => $data['id']))
            ->set('status_code', '-1')
            ->update('service_requests');

        return $rs;
    }


    public function get_request_list($start, $limit)
    {
        $result = $this->db->limit($limit, $start)
            ->where(array('user_code' => $this->user_code))
            ->order_by('req_date')
            ->get('service_requests')->result();
        return $result;
    }
    public function get_request_list_search($query)
    {
        $result = $this->db->where(array('code' => $query, 'user_code' => $this->user_code))
            ->order_by('req_date')
            ->get('service_requests')->result();
        return $result;
    }
    public function get_request_total(){
        $rs = $this->db->where(array('user_code' => $this->user_code))
            ->count_all_results('service_requests');
        return $rs;
    }

    public function request_status_ok($id)
    {
        $rs = $this->db->where(array('id' => $id, 'status_code' => '1'))
            ->count_all_results('service_requests');

        return $rs > 0 ? FALSE : TRUE;
    }

    public function get_request_status_total($status){
        $rs = $this->db
            ->where(array('status_code' => $status, 'user_code' => $this->user_code))
            ->count_all_results('service_requests');
        return $rs;
    }

    public function get_request_status_list($status, $start, $limit)
    {
        $result = $this->db
            ->where(array('status_code' => $status, 'user_code' => $this->user_code))
            ->limit($limit, $start)
            ->order_by('req_date')
            ->get('service_requests')->result();
        return $result;
    }
}