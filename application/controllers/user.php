<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('user_m');
      
		}
    
    public function index(){
      
    }
    
    public function logout (){
      $this->user_m->logout();
      redirect('home');
    }
  
  }

?>