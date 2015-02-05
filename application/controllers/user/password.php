<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Password extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('user_m');
      
		}
		
		public function reset(){
			
			$this->data['subview'] = 'user/signup_success';
			$this->load->view('_main_body_layout', $this->data);
			
		}
  
  }

?>