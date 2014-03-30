<?php
/**
 * Generate serials
 *
 * @author      Satit Rianpit <rianpit@gmail.com>
 * @copyright   Copyright 2012 Scenario Software
 * @since       Version 0.0.1
 * @license     http://www.scenariosoft.in.th/license
 */
class Serial_model extends CI_Model
{
    /**
     * Get current serial number
     *
     * @param   string  $sr_type    Type of serial
     *
     * @return  string
     */
    function get_serial($sr_type){

        $result = $this->db->select('sr_no')
                        ->where('sr_type', $sr_type)
                        ->get('serials')
                        ->row();
        return $result->sr_no;
    }

    /**
     * Update serial
     *
     * @param   string  $sr_type    Update serial
     * @return  void
     */
    function update_serial($sr_type){

        $this->db->set('sr_no', 'sr_no+1',FALSE)
                ->where('sr_type', $sr_type)
                ->update('serials');
    }

    /**
     * Get prefix of serial
     *
     * @param   string  $sr_type    The serial type
     * @return  string String prefix
     */
    function get_prefix($sr_type){

        $result = $this->db->select('prefix')
                        ->where('sr_type', $sr_type)
                        ->get('serials')
                        ->row();

        if(empty($result->prefix)){  //serial don't exist
            /**
             * Before create new prefix must check prefix table serial_configs, if don't exist,
             * must check in serial_defaults for get default prefix
             */

            $prefix = $this->get_prefix_config($sr_type);
            //create new serials for this owner
            $this->create_prefix_serial($sr_type, $prefix);

            return $prefix;

        }else{
            return $result->prefix;
        }
    }

    function get_gen_date($sr_type)
    {
        $rs = $this->db->where('sr_type', $sr_type)
            ->get('serials')
            ->row();
        return $rs->chk_date == '1' ? TRUE : FALSE;
    }

    /**
     * Create prefix
     *
     * Create prefix in serial table, before create must check default prefix in table serial_configs
     * and if no configuration for this prefix, check it in serial_defaults for default prefix
     *
     * @param   string  $sr_type
     * @param   string  $branch_id
     * @param   string  $prefix
     *
     * @return void
     */
    function create_prefix_serial($sr_type, $prefix){

        $current_year = date('Y') + 543;
        $short_year = substr($current_year, -2) ;

        $this->db->set('sr_type', $sr_type)
                    ->set('sr_no', 1)
                    ->set('sr_y', $short_year)
                    ->set('sr_m', date('m'))
                    ->set('prefix', $prefix)
                    ->insert('serials');

    }
    /**
     * Get month prefix (2 digits)
     *
     * @param   string  $sr_type    Serial type
     *
     * @return  string              Month prefix
     */
    function get_month_prefix($sr_type){

        $result = $this->db->select('sr_m')
                        ->where('sr_type', $sr_type)
                        ->get('serials')
                        ->row();

        return $result->sr_m;
    }

    /**
     * Get year prefix (2 digits)
     *
     * @param   string  $sr_type    Serial type
     * @param   int     $branch_id   Owner id
     * @return  string              Year prefix
     */
    function get_year_prefix($sr_type){

        $result = $this->db->select('sr_y')
                            ->where('sr_type', $sr_type)
                            ->get('serials')
                            ->row();

        return $result->sr_y;
    }

    /**
     * Update month
     *
     * @param   string  $sr_type    Serial type
     * @param   string  $month      The month 2 digits
     * @param   int     $branch_id   Owner id
     *
     * @return  void
     */
    function update_month($sr_type, $month){
        $this->db->set('sr_m', $month)
                ->where('sr_type', $sr_type)
                ->update('serials');
    }

    /**
     * Update year
     *
     * @param   string  $sr_type    Serial type
     * @param   string  $year       New year
     * @param   int     $branch_id   Owner id
     *
     * @return  void
     */
    function update_year($sr_type, $year){
        $this->db->set('sr_y', $year)
                ->where('sr_type', $sr_type)
                ->update('serials');
    }
    /**
     * Reset serial
     *
     * @param   string  $sr_type    Serial type
     * @param   int     $branch_id   Owner id
     * @return  void
     */
    function reset_serial($sr_type){
        $this->db->set('sr_no', 1)
                 ->where('sr_type', $sr_type)
                 ->update('serials');
    }

    /**
     * Get serial prefix config
     *
     * @param $sr_type
     * @param $branch_id
     *
     * @return string
     */
    public function get_prefix_config($sr_type){

        $result = $this->db->select(array('prefix'))
                           ->where('sr_type', $sr_type)
                           ->get('serial_configs')
                           ->row();

        if(empty($result->prefix)){
            //get default prefix
            $prefix = $this->get_default_prefix($sr_type);
            //create new prefix for this serial type
            $this->create_prefix_config($sr_type, $prefix);

            return $prefix;
        }else{
            return $result->prefix;
        }
    }

    private function get_default_prefix($sr_type){

        $result = $this->db->where('sr_type', $sr_type)
                            ->limit(1)
                            ->get('serial_defaults')
                            ->row();
        return $result->prefix;
    }
    /**
     * Create new prefix config
     *
     * @param   $sr_type
     * @param   $prefix
     *
     * @return  void
     */
    private function create_prefix_config($sr_type, $prefix){

        $this->db->set('sr_type', $sr_type)
                    ->set('prefix', $prefix)
                    ->insert('serial_configs');
    }
}
