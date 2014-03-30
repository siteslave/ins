<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db->limit($limit, $start)->order_by('name')->get('suppliers')->result();
        return $result;
    }
    public function get_list_total(){
    	$rs = $this->db->count_all_results('suppliers');
    	return $rs;
    }
    public function get_all()
    {
        $result = $this->db->order_by('name')->get('suppliers')->result();
        return $result;
    }

    public function save($data){
        $result = $this->db
                    ->set('code', $data['code'])
                    ->set('name', $data['name'])
                    ->set('address', $data['address'])
                    ->set('contact_name', $data['contact_name'])
                    ->set('telephone', $data['telephone'])
                    ->set('fax', $data['fax'])
                    ->set('email', $data['email'])
                    ->insert('suppliers');
        return $result;
    }

    public function check_duplicate_name($name){
        $result = $this->db->where('name', $name)->count_all_results('suppliers');

        return $result > 0 ? TRUE : FALSE;
    }

    public function check_duplicate_code($code){
        $result = $this->db->where('code', $code)->count_all_results('suppliers');

        return $result > 0 ? TRUE : FALSE;
    }


    public function update($data){
        $result = $this->db->where('code', $data['code'])
            ->set('name', $data['name'])
            ->set('address', $data['address'])
            ->set('contact_name', $data['contact_name'])
            ->set('telephone', $data['telephone'])
            ->set('fax', $data['fax'])
            ->set('email', $data['email'])
            ->update('suppliers');
        return $result;
    }

    public function remove($code){
        $result = $this->db->where('code', $code)->delete('suppliers');
        return $result;
    }

    public function search($query){
        $sql = '
                select * from suppliers
                where code="'. $query .'"
                or name like "%'.$query.'%" limit 50
                ';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }

    public function get_detail($code){
        $rs = $this->db->where('code', $code)->get('suppliers')->row();
        return $rs;
    }



}
