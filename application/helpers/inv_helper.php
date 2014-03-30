<?php
if ( ! function_exists('render_json'))
{
    function render_json($json)
    {
        ini_set('display_errors', 0);
        header('Content-Type: application/json');
        echo $json;
    }

}
if ( ! function_exists('get_current_thai_date'))
{
    function get_current_thai_date()
    {
        $d = explode('/', date('d/m/Y'));
        $day = $d[0];
        $month = $d[1];
        $year = (int) $d[2] + 543;

        $current_thai_date = $day . '/' . $month . '/' . $year;
        return $current_thai_date;

    }

}

if ( ! function_exists('get_fullname') ) {
    function get_fullname( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('fullname')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result->fullname;
    }
}
if ( ! function_exists('get_user_fullname') ) {
    function get_user_fullname( $code ) {
        $ci =& get_instance();

        $result = $ci->db->select('fullname')
            ->where('user_code', $code)
            ->get('users')
            ->row();
        return $result->fullname;
    }
}

if ( ! function_exists('get_company_detail') ) {
    function get_company_detail() {
        $ci =& get_instance();

        $result = $ci->db
            ->limit(1)
            ->get('companies')
            ->row();
        return $result;
    }
}

if ( ! function_exists('get_item_name') ) {
    function get_item_name( $id ) {
        $ci =& get_instance();

        $result = $ci->db->select('name')
            ->where('id', $id)
            ->get('items')
            ->row();
        return $result->name;
    }
}

if ( ! function_exists('get_company_name') ) {
    function get_company_name( $code ) {
        $ci =& get_instance();

        $result = $ci->db->select('name')
            ->where('code', $code)
            ->get('suppliers')
            ->row();
        return $result->name;
    }
}
if ( ! function_exists('get_customer_name') ) {
    function get_customer_name( $code ) {
        $ci =& get_instance();

        $result = $ci->db->select('name')
            ->where('code', $code)
            ->get('customers')
            ->row();
        return $result->name;
    }
}
if ( ! function_exists('get_service_item_id') ) {
    function get_service_item_id( $id ) {
        $ci =& get_instance();

        $result = $ci->db->select('item_id')
            ->where('id', $id)
            ->get('service_items')
            ->row();
        return $result->item_id;
    }
}

if ( ! function_exists('get_user_type') ) {
    function get_user_type( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('user_type')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result->user_type;
    }
}

if ( ! function_exists('get_user_status') ) {
    function get_user_status( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('user_status')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result->user_status;
    }
}
if ( ! function_exists('get_user_code') ) {
    function get_user_code( $username ) {
        $ci =& get_instance();

        $result = $ci->db->select('user_code')
            ->where('username', $username)
            ->get('users')
            ->row();
        return $result->user_code;
    }
}

if(!function_exists('get_current_name')){
    function get_current_name(){
        $ci =& get_instance();

        return $ci->session->userdata('fullname');
    }
}
if(!function_exists('get_admin_list')){
    function get_admin_list(){
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');
        $rs = $ci->basic->get_admin_list();

        return $rs;
    }
}
if(!function_exists('get_technician_list')){
    function get_technician_list(){
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');
        $rs = $ci->basic->get_technician_list();

        return $rs;
    }
}


/**
 * Get user agent
 *
 * @return string User agent
 **/
if ( ! function_exists( 'get_user_agent' ) )
{
    function get_user_agent()
    {
        $ci =& get_instance();
        if ( $ci->agent->is_browser() )
        {
            $agent = $ci->agent->browser() . ' ' . $ci->agent->version() . ' ' . $ci->agent->platform();
        }
        elseif( $ci->agent->is_robot() )
        {
            $agent = $ci->agent->robot();
        }
        elseif( $ci->agent->is_mobile() )
        {
            $agent = $this->agent->mobile();
        }
        else
        {
            $agent = 'Unknow agent';
        }

        return $agent;
    }
}

/**
 * Create logging
 *
 * @param string $log_level Log level 'info', 'warning', 'error'
 * @param string $log_message
 * @param string $log_ip User ip address
 * @param string $log_agent User agent
 **/
if ( ! function_exists( 'logging' ) )
{
    function logging( $logs )
    {
        $ci =& get_instance();

        date_default_timezone_set('Asia/Bangkok');

        $logs['log_date'] = date("Y-m-d");
        $logs['log_time'] = date("H:i:s");
        $logs['log_user'] = $ci->session->userdata('user_name');

        $ci->db->insert( 'logs', $logs );
    }
}
/**
 * Generate serial
 *
 * @param   string  $sr_type Type of serial
 * @param   boolean $gen_date Add 2 digits of year to serial
 * @return  string
 */
if ( ! function_exists('generate_serial'))
{
    function generate_serial($sr_type)
    {
        $ci =& get_instance();
        $ci->load->model('Serial_model', 'serial');
        //Generate serial with year and month digit.

        $prefix = $ci->serial->get_prefix($sr_type);
        $gen_date = $ci->serial->get_gen_date($sr_type);

        //generate with year and month
        if($gen_date){
            //formatted serial
            $sr_m = $ci->serial->get_month_prefix($sr_type);
            $sr_y = $ci->serial->get_year_prefix($sr_type);

            //for month prefix
            if($sr_m != date('m')){
                //update month
                $ci->serial->update_month($sr_type, date('m'));
                //set to current month
                $sr_m = date('m');
                $ci->serial->reset_serial($sr_type);
            }

            //for year prefix
            $current_year = date('Y') + 543;
            $short_year = substr($current_year, -2) ;

            if($sr_y != $short_year){
                //update year
                $ci->serial->update_year($sr_type, $short_year);
				$ci->serial->reset_serial($sr_type);
            }

            $new_sr = $prefix.'-'.$short_year.$sr_m;

        }else{//generate without year and month
            $new_sr = $prefix;
        }

        $sn = $ci->serial->get_serial($sr_type);
        $sn = get_string_length($sn);

        $a = $new_sr. '-' .$sn;

        //Update serials
        $ci->serial->update_serial($sr_type);

        return $a;
    }
}
//private function for serial
function get_string_length($sn){

    switch(strlen($sn)){
        case 1:
            $new_sn = '00000'.$sn;
            break;
        case 2:
            $new_sn = '0000'.$sn;
            break;
        case 3:
            $new_sn = '000'.$sn;
            break;
        case 4:
            $new_sn = '00'.$sn;
            break;
        case 5:
            $new_sn = '0'.$sn;
            break;
        case 6:
            $new_sn = $sn;
            break;
        default:
            $new_sn = '000001';
    }
    return $new_sn;
}

if( !function_exists('gen_unique')){
    function gen_unique(){
        $id = uniqid(hash("sha512",rand()), TRUE);
        $code = hash("sha512", $id);
        return substr($code, 0, 32);
    }
}

if(!function_exists('to_thai_date')){
    function to_thai_date($eng_date){
        if(strlen($eng_date) != 10){
            return null;
        }else{
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}

if(!function_exists('js_to_thai_date')){
    function js_to_thai_date($eng_date){
        if(strlen($eng_date) != 10){
            return null;
        }else{
            $new_date = explode('/', $eng_date);

            $new_y = (int) $new_date[2] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}

if(!function_exists('to_mysql_date')){
    function to_mysql_date($thai_date){
        if(strlen($thai_date) != 10){
            return null;
        }else{
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y . '-' . $new_m . '-' . $new_d;

            return $mysql_date;
        }
    }
}

if(!function_exists('get_status_list')){
    function get_status_list(){
        $status = array(
            '1' => 'รอซ่อม',
            '2' => 'กำลังซ่อม',
            '3' => 'พักการซ่อม',
            '4' => 'ยกเลิกการซ่อม',
            '5' => 'ส่งซ่อม',
            '6' => 'ส่งเคลม',
            '7' => 'ซ่อมเสร็จ',
            '8' => 'รับเครื่องกลับ'
        );

        return $status;
    }
}

if(!function_exists('get_status_name')){
    function get_status_name($status){
        switch($status){
            case '1': return 'รอซ่อม'; break;
            case '2': return 'กำลังซ่อม'; break;
            case '3': return 'พักการซ่อม'; break;
            case '4': return 'ยกเลิกการซ่อม'; break;
            case '5': return 'ส่งซ่อม'; break;
            case '6': return 'ส่งเคลม'; break;
            case '7': return 'ซ่อมเสร็จ'; break;
            case '8': return 'รับเครื่องกลับ'; break;
            default: return '-'; break;
        }
    }
}

if(! function_exists('get_priority_list'))
{
    function get_priority_list()
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $rs = $ci->basic->get_priority_list();

        return $rs;
    }
}
if(! function_exists('get_charge_item_list'))
{
    function get_other_device_list()
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $rs = $ci->basic->get_other_device_list();

        return $rs;
    }
}
if(! function_exists('get_customer_list'))
{
    function get_customer_list()
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $rs = $ci->basic->get_customer_list();

        return $rs;
    }
}

if(! function_exists('string_to_js_date'))
{
    function string_to_js_date($date)
    {
        $d = substr($date, 0, 2);
        $m = substr($date, 2, 2);
        $y = substr($date, 4, 4);

        return $d . '/' . $m . '/' . $y;
    }
}

if(! function_exists('count_age'))
{
    function count_age($date)
    {
        $c_y = (int) date('Y');
        $o_y = (int) explode('-', $date);
        $n_y = (int) $o_y[0];

        return $c_y - $n_y;
    }
}
