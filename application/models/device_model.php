<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Device_model extends CI_Model
{

    public function get_list($start, $limit)
    {
        $result = $this->db->limit($limit, $start)->order_by('name')->get('other_devices')->result();
        return $result;
    }
    public function get_list_all()
    {
        $result = $this->db->order_by('name')->get('other_devices')->result();
        return $result;
    }
	public function get_list_total(){
    	$rs = $this->db->count_all_results('other_devices');
    	return $rs;
    }

    public function save($data){
        $result = $this->db
                    ->set('name', $data['name'])
                    ->set('code', $data['code'])
                    ->insert('other_devices');
        return $result;
    }

    public function check_duplicate_name($name){
        $result = $this->db->where('name', $name)->count_all_results('other_devices');

        return $result > 0 ? TRUE : FALSE;
    }

    public function check_duplicate_code($code){
        $result = $this->db->where('code', $code)->count_all_results('other_devices');

        return $result > 0 ? TRUE : FALSE;
    }

    public function update($data){
        $result = $this->db->where('code', $data['code'])
            ->set('name', $data['name'])
            ->update('other_devices');
        return $result;
    }

    public function remove($code){
        $result = $this->db->where('code', $code)->delete('other_devices');
        return $result;
    }

    public function search($query){
        $sql = '
            select * from other_devices
            where code="'.$query.'" or name like "%'.$query.'%"
            limit 50
        ';

        $rs = $this->db->query($sql)->result();

        return $rs;
    }
}
