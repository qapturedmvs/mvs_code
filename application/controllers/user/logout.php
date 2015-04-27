<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Logout extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
			
		}
    
    public function index(){
      
			$this->user_m->destroy_autologin($this->user['usr_id'], $this->input->cookie('mvs_lgn_cookie', TRUE));
			
			delete_cookie('mvs_lgn_cookie');
			
			$this->session->sess_destroy();
			
      redirect('', 'refresh');
    }
  
  }

?>