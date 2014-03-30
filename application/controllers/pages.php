<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
    public function __construct(){
        parent::__construct();
        //$this->layout->setLayout('default_layout');
        $username = $this->session->userdata('username');

        if(empty($username)) redirect(site_url('users/login'));
    }

    public function index(){
        $this->layout->view('pages/index_view');
    }
}