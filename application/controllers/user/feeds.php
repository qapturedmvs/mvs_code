<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feeds extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->session_check();
			$this->load->model('feed_m');
      
		}
    
    public function index(){
			
			$this->data['subview'] = 'user/feeds';
			$this->load->view('_main_body_layout', $this->data);
      
    }
  
  }

?>