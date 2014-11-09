<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		function __construct(){
			parent::__construct();
		}
		
		public function index(){
			
			$this->data['subview'] = 'movie/list';
			$this->load->view('_main_body_layout', $this->data);	
			
		}
			
	}

?>