<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dashboard extends Backend_Controller{
		function __construct(){
			parent::__construct();
		}
		
		public function index(){
			
			$this->data['subview'] = 'admin/dashboard';
			$this->load->view('admin/_main_body_layout', $this->data);	
			
		}
			
	}

?>