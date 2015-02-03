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
				
				$rules = $this->config->config['usr_login'];
				$this->form_validation->set_rules($rules);
				
				if($this->form_validation->run() === TRUE){
								$db_data = $this->user_m->login($data['lgn_email'], $data['lgn_password']);
					if($db_data && $db_data['data']->usr_act == 1){
				
								$data = array(
								  'usr_name' => $user['data'][0]->usr_name,
								  'usr_email' => $user['data'][0]->usr_email,
								  'usr_id' => $user['data'][0]->usr_id,
								  'usr_loggedin' => TRUE,
								);
									
								$this->session->set_userdata($data);
												
								redirect($successPage);
										
					}elseif($db_data && $db_data['data']->usr_act == 0){
								$this->data['login_error'] = 'Please activate your account.';
					}else{
						$this->data['login_error'] = 'That email/password combination does not exist';
					}
				}else{
				    $this->data['login_error'] = validation_errors();
				}
				
		}
		
		private function _signup($data, $successPage){
				
				$rules = $this->config->config['usr_signup'];
				$this->form_validation->set_rules($rules);
				
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