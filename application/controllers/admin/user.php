<?php
class User extends Backend_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function login(){	
        $this->data['subview'] = 'admin/pages/_view_login';
        $this->load->view('admin/_main_body_layout', $this->data);
    }

}