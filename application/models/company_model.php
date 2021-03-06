<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model {

    public function get_detail(){
        $rs = $this->db->limit(1)->get('companies')->row();

        return $rs;
    }

    public function save($data){
        $result = $this->db
            ->set('name', $data['name'])
            ->set('address', $data['address'])
            ->set('telephone', $data['telephone'])
            ->set('fax', $data['fax'])
            ->set('email', $data['email'])
            ->set('tax_code', $data['tax_code'])
            ->set('url', $data['url'])
            ->update('companies');
        return $result;
    }

}
