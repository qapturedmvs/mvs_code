<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feeds extends User_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->session_check();
			$this->load->model('feed_m');
      
		}
    
    public function index(){
			
			// SET PAGE LOAD TIME
			$this->session->set_userdata('feeds_loaded', date("Y-m-d H:i:s"));

			$this->data['subview'] = 'user/feeds';
			$this->load->view('_main_body_layout', $this->data);
      
    }
  
  }

?>