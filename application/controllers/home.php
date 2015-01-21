<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Home extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
		}
		
		public function index(){
			
			// Redirect a user if he's already logged in
				$home = 'user/wall';
				$this->user_m->loggedin() == FALSE || redirect($home);
				
				// Set form
				$rules = $this->config->config['usr_login'];
				$this->form_validation->set_rules($rules);
				
				// Process form
				if ($this->form_validation->run() == TRUE){
					
					// We can login and redirect
					if ($this->user_m->login() == TRUE) {
						redirect($home);
					}
					else {
						$this->session->set_flashdata('error', 'That email/password combination does not exist');
						redirect('home', 'refresh');
					}
				}
			
			$this->data['subview'] = 'home';
			$this->load->view('_main_body_layout', $this->data);	
			
		}
			
				

	}

?>