<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db
                        ->select(array(
                            'p.code as product_code', 'p.product_serial', 'p.spec',
                            'p.purchase_price', 'p.purchase_date', 'b.name as brand_name', 'm.name as model_name',
                            't.name as type_name', 'c.name as customer_name', 's.name as supplier_name'
                        ))
                        ->join('product_brands b', 'b.code=p.brand_code', 'left')
                        ->join('product_models m', 'm.code=p.model_code', 'left')
                        ->join('product_types t', 't.code=p.type_code', 'left')
                        ->join('customers c', 'c.code=p.customer_code', 'left')
                        ->join('suppliers s', 's.code=p.supplier_code', 'left')
                        ->order_by('p.code')
                        ->limit($limit, $start)
                        ->get('products p')
                        ->result();
        return $result;
    }

    public function get_list_all()
    {
        $result = $this->db
                        ->select(array(
                            'p.code as product_code', 'p.product_serial', 'p.spec',
                            'p.purchase_price', 'p.purchase_date', 'b.name as brand_name', 'm.name as model_name',
                            't.name as type_name', 'c.name as customer_name', 's.name as supplier_name'
                        ))
                        ->join('product_brands b', 'b.code=p.brand_code', 'left')
                        ->join('product_models m', 'm.code=p.model_code', 'left')
                        ->join('product_types t', 't.code=p.type_code', 'left')
                        ->join('customers c', 'c.code=p.customer_code', 'left')
                        ->join('suppliers s', 's.code=p.supplier_code', 'left')
                        ->order_by('p.code')
                        ->get('products p')
                        ->result();
        return $result;
    }

    public function get_total(){
        $result = $this->db->count_all_results('products');
        return $result;
    }

    public function get_customer(){
        $result = $this->db->order_by('name')->get('customers')->result();
        return $result;
    }
    public function get_type(){
        $result = $this->db->order_by('name')->get('product_types')->result();
        return $result;
    }

    public function get_brand(){
        $result = $this->db->order_by('name')->get('product_brands')->result();
        return $result;
    }

    public function get_model(){
        $result = $this->db->order_by('name')->get('product_models')->result();
        return $result;
    }
    //get color
    public function get_color(){
        $result = $this->db->order_by('name')->get('product_colors')->result();
        return $result;
    }

    public function get_supplier(){
        $result = $this->db->order_by('name')->get('suppliers')->result();
        return $result;
    }

    public function search($query, $start, $limit){
        $result = $this->db
                        ->select(array(
                            'p.code as product_code', 'p.product_serial', 'p.spec',
                            'p.purchase_price', 'p.purchase_date', 'b.name as brand_name', 'm.name as model_name',
                            't.name as type_name', 'c.name as customer_name', 's.name as supplier_name'
                        ))
                        ->join('product_brands b', 'b.code=p.brand_code', 'left')
                        ->join('product_models m', 'm.code=p.model_code', 'left')
                        ->join('product_types t', 't.code=p.type_code', 'left')
                        ->join('customers c', 'c.code=p.customer_code', 'left')
                        ->join('suppliers s', 's.code=p.supplier_code', 'left')
                        ->where('p.code', $query)
                        ->order_by('p.code')
                        ->limit($limit, $start)
                        ->get('products p')
                        ->result();
        return $result;
    }
    public function search_total($query){
    	$rs = $this->db->where('code', $query)->count_all_results('products');
    	return $rs;
    }
    public function search_filter($type_code, $customer_code, $start, $limit){
        if(empty($type_code)){
            $result = $this->db
                            ->select(array(
                                'p.code as product_code', 'p.product_serial', 'p.spec',
                                'p.purchase_price', 'p.purchase_date', 'b.name as brand_name', 'm.name as model_name',
                                't.name as type_name', 'c.name as customer_name', 's.name as supplier_name'
                            ))
                            ->join('product_brands b', 'b.code=p.brand_code', 'left')
                            ->join('product_models m', 'm.code=p.model_code', 'left')
                            ->join('product_types t', 't.code=p.type_code', 'left')
                            ->join('customers c', 'c.code=p.customer_code', 'left')
                            ->join('suppliers s', 's.code=p.supplier_code', 'left')
                            //->where('p.type_code', $type_code)
                            ->where('p.customer_code', $customer_code)
                            ->order_by('p.code')
                            ->limit($limit, $start)
                            ->get('products p')
                            ->result();
        }else{
            $result = $this->db
                            ->select(array(
                                'p.code as product_code', 'p.product_serial', 'p.spec',
                                'p.purchase_price', 'p.purchase_date', 'b.name as brand_name', 'm.name as model_name',
                                't.name as type_name', 'c.name as customer_name', 's.name as supplier_name'
                            ))
                            ->join('product_brands b', 'b.code=p.brand_code', 'left')
                            ->join('product_models m', 'm.code=p.model_code', 'left')
                            ->join('product_types t', 't.code=p.type_code', 'left')
                            ->join('customers c', 'c.code=p.customer_code', 'left')
                            ->join('suppliers s', 's.code=p.supplier_code', 'left')
                            ->where('p.type_code', $type_code)
                            ->where('p.customer_code', $customer_code)
                            ->order_by('p.code')
                            ->limit($limit, $start)
                            ->get('products p')
                            ->result();
        }
        return $result;
    }

    public function search_filter_all($type_code, $customer_code){
        if(empty($type_code)){
            $result = $this->db
                            ->select(array(
                                'p.code as product_code', 'p.product_serial', 'p.spec',
                                'p.purchase_price', 'p.purchase_date', 'b.name as brand_name', 'm.name as model_name',
                                't.name as type_name', 'c.name as customer_name', 's.name as supplier_name'
                            ))
                            ->join('product_brands b', 'b.code=p.brand_code', 'left')
                            ->join('product_models m', 'm.code=p.model_code', 'left')
                            ->join('product_types t', 't.code=p.type_code', 'left')
                            ->join('customers c', 'c.code=p.customer_code', 'left')
                            ->join('suppliers s', 's.code=p.supplier_code', 'left')
                            //->where('p.type_code', $type_code)
                            ->where('p.customer_code', $customer_code)
                            ->order_by('p.code')
                            ->get('products p')
                            ->result();
        }else{
            $result = $this->db
                            ->select(array(
                                'p.code as product_code', 'p.product_serial', 'p.spec',
                                'p.purchase_price', 'p.purchase_date', 'b.name as brand_name', 'm.name as model_name',
                                't.name as type_name', 'c.name as customer_name', 's.name as supplier_name'
                            ))
                            ->join('product_brands b', 'b.code=p.brand_code', 'left')
                            ->join('product_models m', 'm.code=p.model_code', 'left')
                            ->join('product_types t', 't.code=p.type_code', 'left')
                            ->join('customers c', 'c.code=p.customer_code', 'left')
                            ->join('suppliers s', 's.code=p.supplier_code', 'left')
                            ->where('p.type_code', $type_code)
                            ->where('p.customer_code', $customer_code)
                            ->order_by('p.code')
                            ->get('products p')
                            ->result();
        }
        return $result;
    }

    public function search_filter_total($type_code, $customer_code){
    	if(empty($type_code)){
    	    $rs = $this->db
            		//->where('type_code', $type_code)
                    ->where('customer_code', $customer_code)
                    ->count_all_results('products');
    	}else{
    	    $rs = $this->db
        		->where('type_code', $type_code)
                ->where('customer_code', $customer_code)
                ->count_all_results('products');
    	}
    	return $rs;
    }


    public function check_duplicate($code){
        $result = $this->db->where('code', $code)->count_all_results('products');
        return $result > 0 ? TRUE : FALSE;
    }

    public function save($data){
        $result = $this->db->set('code', $data['code'])
                            ->set('product_serial', $data['product_serial'])
                            ->set('purchase_price', $data['purchase_price'])
                            ->set('purchase_date', $data['purchase_date'])
                            ->set('brand_code', $data['brand_code'])
                            ->set('model_code', $data['model_code'])
                            ->set('color_code', $data['color_code'])
                            ->set('spec', $data['spec'])
                            ->set('customer_code', $data['customer_code'])
                            ->set('type_code', $data['type_code'])
                            ->set('supplier_code', $data['supplier_code'])
                            ->insert('products');
        return $result;
    }

    public function update($data){
        $result = $this->db->set('product_serial', $data['product_serial'])
                            ->set('purchase_price', $data['purchase_price'])
                            ->set('purchase_date', $data['purchase_date'])
                            ->set('brand_code', $data['brand_code'])
                            ->set('model_code', $data['model_code'])
                            ->set('color_code', $data['color_code'])
                            ->set('spec', $data['spec'])
                            ->set('customer_code', $data['customer_code'])
                            ->set('type_code', $data['type_code'])
                            ->set('supplier_code', $data['supplier_code'])
                            ->where('code', $data['code'])
                            ->update('products');
        return $result;
    }


    public function detail($product_code){
        $result = $this->db
                    ->select(array(
                            'p.*', 's.name as supplier_name',
                            'c.name as customer_name',
                            ))
                    ->join('suppliers s', 's.code=p.supplier_code')
                    ->join('customers c', 'c.code=p.customer_code')
                    ->where('p.code', $product_code)
                    ->get('products p')->row();
        return $result;
    }

    public function remove($product_code){
        $result = $this->db->where('code', $product_code)->delete('products');
        return $result;
    }

    public function search_customer($query){
        $sql = '
                select * from customers
                where code="'. $query .'"
                or name like "%'.$query.'%" limit 20
                ';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }
    public function search_supplier($query){
        $sql = '
                select * from suppliers
                where code="'. $query .'"
                or name like "%'.$query.'%" limit 20
                ';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

    public function search_ajax($query)
    {
        $sql = '
        select p.code as product_code, c.name as customer_name, s.name as supplier_name,
        t.name as type_name, m.name as model_name, b.name as brand_name
        from products p
        left join product_brands b on b.code=p.brand_code
        left join product_models m on m.code=p.model_code
        left join product_types t on t.code=p.type_code
        left join suppliers s on s.code=p.supplier_code
        left join customers c on c.code=p.customer_code

        where (p.code like "%'.$query.'%"
        or p.product_serial like "%'.$query.'%" or t.name like "%'.$query.'%")
        limit 20
        ';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }
    public function get_detail($code)
    {
        $sql = '
        select p.code as product_code, p.product_serial, c.name as customer_name, s.name as supplier_name,
        t.name as type_name, m.name as model_name, b.name as brand_name
        from products p
        left join product_brands b on b.code=p.brand_code
        left join product_models m on m.code=p.model_code
        left join product_types t on t.code=p.type_code
        left join suppliers s on s.code=p.supplier_code
        left join customers c on c.code=p.customer_code

        where p.code="'.$code.'"';

        $rs = $this->db->query($sql)->result();

        return $rs[0];
    }
}
