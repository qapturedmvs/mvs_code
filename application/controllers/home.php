<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Home extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
			
		}
		
		public function index(){
				
				$this->logged_in === FALSE || redirect('user/feeds');
				$inputs = $this->input->post(NULL, TRUE);
				
				// LOGIN FORM CONTROLS
				if(isset($inputs['lgn_submit']))
				  $this->_login($inputs, 'user/feeds');
				
				// SIGNUP FORM CONTROLS
				if(isset($inputs['sgn_submit']))
				  $this->_signup($inputs, 'user/account/success');
				
			$this->data['subview'] = 'home';
			$this->load->view('_main_body_layout', $this->data);	
			
		}
		
		private function _login($data, $successPage){
				
				// Set form
				$rules = $this->config->config['usr_login'];
				$this->form_validation->set_rules($rules);
				
				// Process form
				if($this->form_validation->run() === TRUE){
					// We can login and redirect
					if($this->user_m->login($data['lgn_email'], $data['lgn_password']) === TRUE){
						redirect($successPage);
					}else{
						$this->data['login_error'] = 'That email/password combination does not exist';
					}
				}else{
				    $this->data['login_error'] = validation_errors();
				}
				
		}
		
		private function _signup($data, $successPage){
				
				// Set form
				$rules = $this->config->config['usr_signup'];
				$this->form_validation->set_rules($rules);
				
				// Process form
				if($this->form_validation->run() === TRUE){
					
					$new_user = $this->user_m->signup($data['sgn_name'], $data['sgn_email'], $data['sgn_password']);
					
					if($new_user){
						$data['tmp_usr_act_key'] = $new_user['usr_act_key'];
						$this->session->set_userdata($data);
						redirect($successPage, 'refresh');
					}else{
						$this->data['signup_error'] = 'This email is already registered. Want to login or recover your password?';
					}
				}else{
				    $this->data['signup_error'] = validation_errors();
				}
				
		}
			
				

	}

?>