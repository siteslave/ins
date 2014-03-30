<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{

    public $status;
    public $user_code;
    public $customer_code;
    public $technician_code;

    public function save_register($data)
    {
        $rs = $this->db
            ->set('service_code', $data['service_code'])
            ->set('product_code', $data['product_code'])
            ->set('date_serv', $data['date_serv'])
            ->set('contact_name', $data['contact_name'])
            ->set('customer_code', $data['customer_code'])
            ->set('contact_telephone', $data['contact_telephone'])
            ->set('priority', $data['priority'])
            ->set('cause', $data['cause'])
            ->set('register_by', $data['user_code'])
            ->set('service_status', '1')
            ->insert('services');

        return $rs;
    }
    public function update_register($data)
    {
        $rs = $this->db
            ->where(array('service_code' => $data['service_code']))
            ->set('date_serv', $data['date_serv'])
            ->set('contact_name', $data['contact_name'])
            ->set('customer_code', $data['customer_code'])
            ->set('contact_telephone', $data['contact_telephone'])
            ->set('priority', $data['priority'])
            ->set('cause', $data['cause'])
            ->set('register_by', $data['user_code'])
            ->update('services');

        return $rs;
    }
    public function save_other_device($service_code, $item_code, $qty)
    {
        $rs = $this->db
            ->set('service_code', $service_code)
            ->set('item_code', $item_code)
            ->set('item_qty', $qty)
            ->insert('service_other_devices');

        return $rs;
    }

    public function remove_all_other_device($service_code)
    {
        $rs = $this->db
            ->where(array('service_code' => $service_code))
            ->delete('service_other_devices');
        return $rs;
    }

    public function check_product_discharged($product_code)
    {
        $rs = $this->db
            ->where(array(
                'product_code' => $product_code,
                'discharge_status' => 'N'
            ))
            ->count_all_results('services');

        return $rs > 0 ? FALSE : TRUE;
    }

    public function get_service_list($start, $limit)
    {
        $this->db->select(array(
                'p.code as product_code', 'p.id as product_id',
                'p.product_serial', 'p.purchase_date', 'c.name as customer_name',
                'b.name as brand_name', 'm.name as model_name', 't.name as type_name',
                's.*', 'u.fullname as technician_name'
            ));
        $this->db->join('products p', 'p.code=s.product_code', 'left');
        $this->db->join('product_brands b', 'b.code=p.brand_code', 'left');
        $this->db->join('product_models m', 'm.code=p.model_code', 'left');
        $this->db->join('product_types t', 't.code=p.type_code', 'left');
        $this->db->join('customers c', 'c.code=s.customer_code', 'left');
        $this->db->join('users u', 'u.user_code=s.technician_code', 'left');
        $this->db->where(array(
                's.service_status' => $this->status
            ));

        if($this->customer_code)
        {
            $this->db->where('s.customer_code', $this->customer_code);
        }

        if($this->technician_code)
        {
            $this->db->where('s.technician_code', $this->technician_code);
        }

        $this->db->limit($limit, $start);
        $this->db->order_by('s.date_serv', 'DESC');
        $rs = $this->db->get('services s');

        $rs = $rs->result();

        return $rs;
    }
    public function get_service_total(){
        $this->db->where(array('s.service_status' => $this->status));

        if($this->customer_code)
        {
            $this->db->where(array('s.customer_code' => $this->customer_code));
        }

        if($this->technician_code)
        {
            $this->db->where(array('s.technician_code' => $this->technician_code));
        }

        $rs = $this->db->count_all_results('services s');

        return $rs;
    }
    public function search_service($service_code)
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
            ->where(array(
                's.service_code' => $service_code
            ))
            ->limit(1)
            ->get('services s')
            ->result();
        return $rs;
    }

    public function get_service_list_date($date_serv, $start, $limit)
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
            ->where(array(
                's.service_status' => $this->status,
                's.date_serv' => $date_serv
            ))
            ->limit($limit, $start)
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }

    public function get_service_total_date($date_serv){
        $rs = $this->db->where(array(
                's.service_status' => $this->status,
                's.date_serv' => $date_serv
            ))
            ->count_all_results('services s');

        return $rs;
    }

    public function save_change_status($data){
        $rs = $this->db->where('service_code', $data['service_code'])
                ->set('service_status', $data['status'])
                ->update('services');
        return $rs;
    }
    public function change_service_status($service_code, $status){
        $rs = $this->db->where('service_code', $service_code)
                ->set('service_status', $status)
                ->update('services');
        return $rs;
    }

    public function save_assign_tech($data){
        $rs = $this->db->where('service_code', $data['service_code'])
                ->set('technician_code', $data['user_code'])
                ->update('services');
        return $rs;
    }

    public function check_technician_owner($user_code, $service_code)
    {
        $rs = $this->db
            ->where(array(
                'technician_code' => $user_code,
                'service_code' => $service_code
            ))
            ->count_all_results('services');

        return $rs > 0 ? TRUE : FALSE;
    }

    public function check_technician_status($service_code)
    {
        $rs = $this->db->where(array(
                'service_code' => $service_code,
                'technician_code' => NULL
            ))
            ->count_all_results('services');

        return $rs > 0 ? TRUE : FALSE;
    }


    public function service_exist($service_code){
        $rs = $this->db->where('service_code', $service_code)->count_all_results('services');

        return $rs > 0 ? TRUE : FALSE;
    }

    public function save_activities($service_code, $result){
        date_default_timezone_set('Asia/Bangkok');

        $act_date = date("Y-m-d");
        $act_time = date("H:i:s");

        $rs = $this->db
                ->set('service_code', $service_code)
                ->set('act_date', $act_date)
                ->set('act_time', $act_time)
                ->set('result', $result)
                ->set('user_code', $this->user_code)
                ->insert('activities_log');
        return $rs;
    }

    public function get_activities($service_code){
        $rs = $this->db->where('a.service_code', $service_code)
            ->select(array('a.act_date', 'a.act_time', 'a.result', 'u.fullname'))
            ->join('users u', 'u.user_code=a.user_code', 'left')
            ->order_by('act_date', 'act_time')
            ->get('activities_log a')
            ->result();
        return $rs;
    }

    public function search_item($query){
        $rs = $this->db->like('name', $query, 'both')->limit(25)->get('items')->result();
        return $rs;
    }

    public function save_charge_item($service_code, $item_code, $qty, $price){
        $rs = $this->db
            ->set('service_code', $service_code)
            ->set('item_code', $item_code)
            ->set('qty', $qty)
            ->set('price', $price)
            ->insert('service_charge_items');
        return $rs;
    }

    public function get_charge_item($service_code){
        $rs = $this->db->where(array('s.service_code' => $service_code))
            ->select(array('s.service_code', 's.price', 's.qty', 's.item_code', 'i.name'))
            ->join('charge_items i', 'i.code=s.item_code', 'left')
            ->get('service_charge_items s')
            ->result();
        return $rs;
    }

    public function remove_charge_item($service_code){
        $rs = $this->db->where(array('service_code' => $service_code))
            ->delete('service_charge_items');

        return $rs;
    }

    public function save_result($data){
        $rs = $this->db->where(array('service_code' => $data['service_code']))
            ->set('discharge_date', to_mysql_date($data['discharge_date']))
            ->set('discharge_status', 'Y')
            ->set('discharge_user', $data['user_code'])
            ->set('service_result', $data['result'])
            ->update('services');
        return $rs;
    }
    
    public function get_result($service_code){
        $rs = $this->db
            ->select(array('discharge_date', 'service_result'))
            ->where(array('service_code' => $service_code))->get('services')->result();
        return $rs ? $rs[0] : NULL;

    }

    public function get_detail($service_code)
    {
        $rs = $this->db
            ->where(array('service_code' => $service_code))
            ->get('services')
            ->result();
        return $rs ? $rs[0] : NULL;
    }

    public function get_print_detail($service_code)
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
            ->where(array(
                's.service_code' => $service_code
            ))
            ->limit(1)
            ->get('services s')
            ->row();
        return $rs;
    }

    public function get_other_device($service_code)
    {
        $rs = $this->db
            ->select(array('s.item_code', 'o.name', 's.item_qty'))
            ->join('other_devices o', 'o.code=s.item_code')
            ->where(array('s.service_code' => $service_code))
            ->get('service_other_devices s')
            ->result();
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
    public function confirm_request($data)
    {
        $rs = $this->db
            ->where(array('id' => $data['id']))
            ->set('status_code', '1')
            ->update('service_requests');

        return $rs;
    }


    public function get_request_list($start, $limit)
    {
        $result = $this->db->limit($limit, $start)
            ->order_by('req_date')
            ->get('service_requests')->result();
        return $result;
    }
    public function get_request_status_list($status, $start, $limit)
    {
        $result = $this->db
            ->where(array('status_code' => $status))
            ->limit($limit, $start)
            ->order_by('req_date')
            ->get('service_requests')->result();
        return $result;
    }
    public function get_request_list_search($query)
    {
        $result = $this->db->where(array('code' => $query))
            ->order_by('req_date')
            ->get('service_requests')->result();
        return $result;
    }
    public function get_request_total(){
        $rs = $this->db
            ->count_all_results('service_requests');
        return $rs;
    }
    public function get_request_status_total($status){
        $rs = $this->db
            ->where(array('status_code' => $status))
            ->count_all_results('service_requests');
        return $rs;
    }

    public function request_status_ok($id)
    {
        $rs = $this->db->where(array('id' => $id, 'status_code' => '1'))
            ->count_all_results('service_requests');

        return $rs > 0 ? FALSE : TRUE;
    }
}
