<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Wall extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->session_check();
			$this->load->model('feed_m');
      
		}
    
    public function index(){
      
    }
  
  }

?>