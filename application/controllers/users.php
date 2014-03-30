<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('login_layout');

        $this->load->model('User_model', 'user');
    }

    public function index(){
        $this->login();
    }
    public function login()
    {
        $this->layout->view('users/login_view');
    }

    public function do_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $validated = $this->user->do_login($username, $password);

        if($validated){
            $user_type = get_user_type($username);
            if($user_type == '1'){
                $data = array(
                    'client_name' => $username,
                    'fullname' => get_fullname($username),
                    'user_type' => get_user_type($username),
                    'user_code' => get_user_code($username)
                );
                $this->session->set_userdata($data);

                redirect(site_url('clients'));
            }else{
                $data = array(
                    'username' => $username,
                    'fullname' => get_fullname($username),
                    'user_type' => get_user_type($username),
                    'user_code' => get_user_code($username)
                );
                $this->session->set_userdata($data);

                redirect(site_url());
            }
        }else{
            $this->login();
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        $this->login();
    }

    public function change_password(){
        $username = $this->session->userdata('username');
        $new_pass = $this->input->post('new_pass');
        $old_pass = $this->input->post('old_pass');

        if(empty($new_pass) || empty($old_pass)){
            $json = '{"success": false, "msg": "กรุณาระบุรหัสผ่านให้ครบ"}';
        }else{
            //check old password
            $chk = $this->user->do_login($username, $old_pass);
            if($chk)
            {
                $rs = $this->user->change_password($username, $new_pass);
                if($rs){
                    $json = '{"success": true}';
                }else{
                    $json = '{"success": false, "msg": "Can\'t change password."}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "รหัสผ่านเดิมไม่ถูกต้อง กรุณาตรวจสอบ"}';
            }

        }

        render_json($json);
    }
}