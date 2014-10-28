<?php
class User extends Backend_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function login(){	
        $this->data['subview'] = 'admin/pages/login_v';
        $this->load->view('admin/_main_body_layout', $this->data);
    }

}