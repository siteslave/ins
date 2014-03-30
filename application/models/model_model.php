<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db
                    ->select(array('m.*', 'b.name as brand_name'))
                    ->join('product_brands b', 'b.code=m.brand_code', 'left')
                    ->limit($limit, $start)
                    ->order_by('m.name')
                    ->get('product_models m')->result();
        return $result;
    }
	public function get_list_total(){
    	$rs = $this->db->count_all_results('product_models');
    	return $rs;
    }

    public function save($data){
        $result = $this->db
                    ->set('name', $data['name'])
                    ->set('code', $data['code'])
                    ->set('brand_code', $data['brand_code'])
                    ->insert('product_models');
        return $result;
    }

    public function check_duplicate_name($name){
        $result = $this->db->where('name', $name)->count_all_results('product_models');

        return $result > 0 ? TRUE : FALSE;
    }

    public function check_duplicate_code($code){
        $result = $this->db->where('code', $code)->count_all_results('product_models');

        return $result > 0 ? TRUE : FALSE;
    }

    public function update($data){
        $result = $this->db->where('code', $data['code'])
            ->set('name', $data['name'])
            ->set('brand_code', $data['brand_code'])
            ->update('product_models');
        return $result;
    }

    public function remove($code){
        $result = $this->db->where('code', $code)->delete('product_models');
        return $result;
    }

    public function search($query){
        $sql = '
            select b.name as brand_name, m.* from product_models m
            left join product_brands b on b.code=m.brand_code
            where m.code="'.$query.'" or m.name like "%'.$query.'%"
            limit 50
        ';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

    public function get_brand_list(){
        $rs = $this->db->order_by('name')->get('product_brands')->result();
        return $rs;
    }

    public function get_list_by_brand($brand_code){
        $rs = $this->db->where('brand_code', $brand_code)->get('product_models')->result();
        return $rs;
    }

}
