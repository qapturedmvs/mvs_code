<?php
class User extends Backend_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function login(){
    	
        $this->data['subview'] = 'admin/login';
        $this->load->view('admin/_layout_main', $this->data);
    }

}