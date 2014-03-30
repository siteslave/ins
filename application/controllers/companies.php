<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Companies extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));

        $this->load->model('Company_model', 'company');


    }

    public function index(){
        $data['companies'] = $this->company->get_detail();
        $this->layout->view('companies/index_view', $data);
    }

    public function save(){
        $data = $this->input->post('data');

        if(empty($data)){
            $json = '{"success": fale, "msg": "No data for save."}';
        }else{
            $rs = $this->company->save($data);

            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false, "msg": "Can\'t not save data, please check your data and try again."}';
            }
        }
        render_json($json);
    }

    public function uploads()
    {
        $error = array('error' => '');
        $this->layout->view('companies/uploads_view', $error);
    }

    public function do_upload()
    {
        $config['upload_path'] = './assets/img';
        $config['allowed_types'] = 'gif';
        $config['max_size'] = '150';
        $config['max_width'] = '150';
        $config['max_height'] = '150';
        $config['file_name'] = 'logo.gif';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload())
        {
            $data = array('error' => $this->upload->display_errors(), 'success' => FALSE);
            $this->layout->view('companies/uploads_view', $data);
        }
        else
        {
            $data = array('data' => $this->upload->data(), 'success' => TRUE);
            $this->layout->view('companies/uploads_view', $data);
            //echo var_dump($data);
        }
    }

}
