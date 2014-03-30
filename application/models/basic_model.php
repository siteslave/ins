<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function get_priority_list()
    {
        $rs = $this->db->get('priorities')->result();
        return $rs;
    }

    public function get_technician_list(){
        $rs = $this->db->where_in('user_type', array('2'))
            ->get('users')
            ->result();
        return $rs;
    }

    public function get_admin_list(){
        $rs = $this->db->where_in('user_type', array('3'))
            ->get('users')
            ->result();
        return $rs;
    }
    public function get_other_device_list(){
        $rs = $this->db->get('other_devices')
            ->result();
        return $rs;
    }
    public function get_customer_list(){
        $rs = $this->db->get('customers')
            ->result();
        return $rs;
    }
}