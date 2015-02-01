<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Home extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
			
		}
		
		public function index(){
				
				// Redirect a user if he's already logged in
				$login_home = 'user/feeds';
				$this->logged_in === FALSE || redirect($login_home);
				$inputs = $this->input->post(NULL, TRUE);
				
				// LOGIN FORM CONTROLS
				if(isset($inputs['lgn_submit']))
				    $this->_login($inputs, $login_home);
				
				// SIGNUP FORM CONTROLS
				if(isset($inputs['sgn_submit']))
				    $this->_signup($inputs, $login_home);
				
			$this->data['subview'] = 'home';
			$this->load->view('_main_body_layout', $this->data);	
			
		}
		
		private function _login($data, $login_home){
				
				// Set form
				$rules = $this->config->config['usr_login'];
				$this->form_validation->set_rules($rules);
				
				// Process form
				if($this->form_validation->run() === TRUE){
					// We can login and redirect
					if($this->user_m->login($data['lgn_email'], $data['lgn_password']) === TRUE){
						redirect($login_home);
					}else{
						$this->data['login_error'] = 'That email/password combination does not exist';
					}
				}else{
				    $this->data['login_error'] = validation_errors();
				}
				
		}
		
		private function _signup($data, $login_home){
				
				// Set form
				$rules = $this->config->config['usr_signup'];
				$this->form_validation->set_rules($rules);
				
				// Process form
				if($this->form_validation->run() === TRUE){
					
					$signup = $this->user_m->signup($data['sgn_name'], $data['sgn_email'], $data['sgn_password']);
					
					if($signup === TRUE){
						redirect($login_home);
					}else{
						$this->data['signup_error'] = 'This email is already registered. Want to login or recover your password?';
					}
				}else{
				    $this->data['signup_error'] = validation_errors();
				}
				
		}
			
				

	}

?>