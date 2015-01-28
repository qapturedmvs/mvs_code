<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Sign extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('user_m');
      
		}
    
    public function index(){
      
    }
		
		public function in(){
			
			// Redirect a user if he's already logged in
				$home = 'user/feeds';
				$this->user_m->loggedin() == FALSE || redirect($home);
				
				// Set form
				$rules = $this->config->config['usr_login'];
				$this->form_validation->set_rules($rules);
				
				// Process form
				if ($this->form_validation->run() == TRUE){
					$inputs = $this->input->post(NULL, TRUE);

					// We can login and redirect
					if ($this->user_m->login($inputs['email'], $inputs['password']) === TRUE) {
						redirect($home);
					}
					else {
						$this->session->set_flashdata('error', 'That email/password combination does not exist');
						redirect('home');
					}
				}
			
		}
		
		public function up(){
			var_dump('MEMBER SIGNED UP!!!');
		}
    
    public function out(){
      $this->user_m->logout();
      redirect('home');
    }
  
  }

?>