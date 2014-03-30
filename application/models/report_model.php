<?php
class Report_model extends CI_Model {
    public function get_total($code){
        $rs = $this->db
                ->where('technician_code', $code)
                ->count_all_results('services');
               
        return $rs;
    }
    public function get_status_total($code){
        $rs = $this->db
                ->where('service_status', $code)
                ->count_all_results('services');

        return $rs;
    }
    public function get_total_by_date($code, $s, $e){
        $rs = $this->db
                ->where('technician_code', $code)
                ->where('date_serv >=', $s)
                ->where('date_serv <=', $e)
                ->count_all_results('services');
               
        return $rs;
    }
    public function get_status_total_by_date($status, $s, $e){
        $rs = $this->db
                ->where('service_status', $status)
                ->where('date_serv >=', $s)
                ->where('date_serv <=', $e)
                ->count_all_results('services');

        return $rs;
    }

    public function get_user_list(){
        $rs = $this->db
                ->where_in('user_type', array('2'))
                ->get('users')
                ->result();
        return $rs;
    }
    public function search_history($query)
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
            ->where(array('s.product_code' => $query))
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }


    public function get_total_success_by_date($user_code, $s, $e){
        $rs = $this->db
            ->where('technician_code', $user_code)
            ->where('date_serv >=', $s)
            ->where('date_serv <=', $e)
            ->where('discharge_status', 'Y')
            ->count_all_results('services');

        return $rs;
    }
    public function get_total_not_success_by_date($user_code, $s, $e){
        $rs = $this->db
            ->where('technician_code', $user_code)
            ->where('date_serv >=', $s)
            ->where('date_serv <=', $e)
            ->where('discharge_status', 'N')
            ->count_all_results('services');

        return $rs;
    }

    public function get_list_by_date_total($s, $e){
        $rs = $this->db
            ->where('date_serv >=', $s)
            ->where('date_serv <=', $e)
            ->count_all_results('services');

        return $rs;
    }

    public function get_list_by_date($s, $e, $start, $limit)
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

            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->limit($limit, $start)
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }

 public function get_service_list_all($s, $e)
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

            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }


    public function get_service_by_technician($user_code, $s, $e, $start, $limit)
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

            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->where('s.technician_code', $user_code)

            ->limit($limit, $start)
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }
    public function get_service_by_technician_all($user_code, $s, $e)
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

            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->where('s.technician_code', $user_code)
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }

    public function get_service_by_customer($customer_code, $s, $e, $start, $limit)
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

            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->where('s.customer_code', $customer_code)

            ->limit($limit, $start)
            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }
    public function get_service_by_customer_all($customer_code, $s, $e)
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

            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->where('s.customer_code', $customer_code)

            ->order_by('s.date_serv', 'DESC')
            ->get('services s')
            ->result();
        return $rs;
    }

    public function get_service_by_customer_total($customer_code, $s, $e){
        $rs = $this->db
            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->where('s.customer_code', $customer_code)

            ->count_all_results('services s');

        return $rs;
    }

    public function get_service_by_technician_total($user_code, $s, $e){
        $rs = $this->db
            ->where('s.date_serv >=', $s)
            ->where('s.date_serv <=', $e)

            ->where('s.technician_code', $user_code)

            ->count_all_results('services s');

        return $rs;
    }

    public function get_total_by_customer()
    {
        $sql = '
        select c.code, c.name, count(*) as t
        from services s
        left join customers c on c.code=s.customer_code
        group by c.code
        order by t desc limit 10
        ';

        $rs = $this->db->query($sql)->result();

        return $rs ? $rs : NULL;
    }
    public function get_total_by_customer_date($s, $e)
    {
        $sql = '
        select c.code, c.name, count(*) as t
        from services s
        join customers c on c.code=s.customer_code
        where s.date_serv between "' . $s . '" and "' . $e . '"
        group by c.code
        order by t desc limit 10
        ';

        $rs = $this->db->query($sql)->result();

        return $rs ? $rs : NULL;
    }
    public function get_total_by_product()
    {
        $sql = '
        select p.code, t.name as type_name,
        b.name as brand_name,
        m.name as model_name,
        count(*) as t
        from services s
        left join products p on p.code=s.product_code
        left join product_types t on t.code=p.type_code
        left join product_brands b on b.code=p.brand_code
		left join product_models m on m.code=p.model_code
        group by p.code
        order by t desc limit 10
        ';

        $rs = $this->db->query($sql)->result();

        return $rs ? $rs : NULL;
    }
    public function get_total_by_product_date($s, $e)
    {
        $sql = '
        select p.code, t.name as type_name,
        b.name as brand_name,
        m.name as model_name,
        count(*) as t
        from services s
        left join products p on p.code=s.product_code
        left join product_types t on t.code=p.type_code
        left join product_brands b on b.code=p.brand_code
		left join product_models m on m.code=p.model_code
		where s.date_serv between "' . $s . '" and "' . $e . '"
        group by p.code
        order by t desc limit 10
        ';

        $rs = $this->db->query($sql)->result();

        return $rs ? $rs : NULL;
    }
}
