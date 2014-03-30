<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $user_type = $this->session->userdata('user_type');

        if($user_type != '3') redirect(site_url('errors/access_denied'));


        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['user_types'] = $this->admin->get_user_type();
        $this->layout->view('admins/index_view', $data);
    }

    public function serials(){
        $data['serials'] = $this->admin->get_serial();
        $this->layout->view('admins/serial_view', $data);
    }

    public function get_list(){
        $rs = $this->admin->get_list();
        if($rs){
            $rows = json_encode($rs);
            $json = '{"success": true, "rows": '.$rows.'}';
        }else{
            $json = '{"success": false, "msg": "Database error, please check your data"}';
        }

        render_json($json);
    }

    public function save(){
        $data = $this->input->post('data');
        if(empty($data)){
            $json = '{"success": false, "msg": "No data for save."}';
        }else{
            //update
            if($data['id']){
                $rs = $this->admin->update($data);
                if($rs){
                    $json = '{"success": true, "msg": "updated"}';
                }else{
                    $json = '{"success": false, "msg": "Can\'t save data, please check your data and try again."}';
                }
            }else{
                $duplicated = $this->admin->check_duplicate($data['username']);
                if($duplicated){
                    $json = '{"success": false, "msg": "Username duplicate, please use another."}';
                }else{
                    $data['code'] = generate_serial('USER');
                    $rs = $this->admin->insert($data);
                    if($rs){
                        $json = '{"success": true, "msg": "inserted"}';
                    }else{
                        $json = '{"success": false, "msg": "Can\'t save data, please check your data and try again."}';
                    }
                }
            }
        }

        render_json($json);
    }

    public function get_detail(){
        $id = $this->input->post('id');
        if(empty($id)){
            $json = '{"success": false, "msg": "User id not found."}';
        }else{
            $rs = $this->admin->get_detail($id);
            if($rs){
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": '.$rows.'}';
            }else{
                $json = '{"success": false, "msg": "No data."}';
            }
        }

        render_json($json);
    }

    public function change_password(){
        $id = $this->input->post('id');
        $password = $this->input->post('password');

        if(empty($id)){
            $json = '{"success": false, "msg": "No user id found."}';
        }else if(empty($password)){
            $json = '{"success": false, "msg": "No new password found."}';
        }else{
            $rs = $this->admin->change_password($id, $password);
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Can\'t change your password please check your data and try again."}';
            }
        }

        render_json($json);

    }

    public function remove(){
        $id = $this->input->post('id');
        if(empty($id)){
            $json = '{"success": false, "msg": "No user id found."}';
        }else{
            //remove
            $rs = $this->admin->remove($id);
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Can\'t remove user please check your data and try again."}';
            }
        }

        render_json($json);
    }

    public function serial_save()
    {
        $data = $this->input->post('data');
        if(empty($data))
        {
            $json = '{"success": false, "msg": "No data for save."}';
        }
        else
        {
            $rs = $this->admin->serial_save($data);
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Can\'t save data please check your data and try again."}';
            }
        }

        render_json($json);
    }

    public function backup()
    {
        $this->load->dbutil();

        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'ins.sql'
        );


        $backup =& $this->dbutil->backup($prefs);

        $db_name = 'ins-bak-'. date("YmdHis") .'.zip';
        $save = './backup/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function restore()
    {
        $this->layout->view('admins/restore_view');
    }

    public function do_restore()
    {

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'zip';
        $config['file_name'] = 'data.zip';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload())
        {
            $data = array('error' => $this->upload->display_errors(), 'success' => FALSE);
            $this->layout->view('admins/restore_view', $data);
        }
        else
        {


            $this->load->library('unzip');

            // Optional: Only take out these files, anything else is ignored
            $this->unzip->allow(array('sql'));

            // Give it one parameter and it will extract to the same folder
            $this->unzip->extract('./uploads/data.zip');

            // or specify a destination directory
            //$this->unzip->extract('uploads/my_archive.zip', '/path/to/directory/');


            $backup = read_file('./uploads/ins.sql');

            if($backup)
            {
                $sql_clean = '';
                foreach (explode("\n", $backup) as $line){

                    if(isset($line[0]) && $line[0] != "#"){
                        $sql_clean .= $line."\n";
                    }

                }

                //echo $sql_clean;

                foreach (explode(";\n", $sql_clean) as $sql){
                    $sql = trim($sql);
                    //echo  $sql.'<br/>============<br/>';
                    if($sql)
                    {
                        $this->db->query($sql);
                    }
                }
                $data = array('data' => $this->upload->data(), 'success' => TRUE);
                $this->layout->view('admins/restore_view', $data);
            }
            else
            {
                $data = array('error' => 'ไม่พบไฟล์ SQL ที่ต้องการนำเข้า', 'success' => FALSE);
                $this->layout->view('admins/restore_view', $data);
            }



            //echo var_dump($data);
        }
    }
}
