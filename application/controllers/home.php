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
				$this->_login($inputs);
			
			// SIGNUP FORM CONTROLS
			if(isset($inputs['sgn_submit']))
				$this->_signup($inputs, 'user/account/success');
				
			$this->data['subview'] = 'home';
			$this->load->view('_main_body_layout', $this->data);	
			
		}
		
		private function _login($data){
	
			$rules = $this->config->config['usr_login'];
			$this->form_validation->set_rules($rules);
			
			if($this->form_validation->run() === TRUE){
				
				$ref = ($data['lgn_ref']) ? $data['lgn_ref'] : 'user/feeds';
				unset($data['lgn_ref']);
				$user = $this->user_m->login($data['lgn_email'], $data['lgn_password']);

				if($user && $user['data']->usr_act == 1){
					
					$data = array(
						'usr_id' => $user['data']->usr_id,
						'usr_nick' => $user['data']->usr_nick,
						'usr_name' => $user['data']->usr_name,
						'usr_email' => $user['data']->usr_email,
						'usr_avatar' => $user['data']->usr_avatar,
						'usr_loggedin' => TRUE,
					);
						
					$this->session->set_userdata($data);
									
					redirect($ref, 'refresh');
									
				}elseif($user && $user['data']->usr_act == 0){

					$this->data['login_error'] = 'Please activate your account. <a href="'.$this->data['site_url'].'user/account/activate?act='.$user['data']->usr_act_key.'">Click here</a> for sending activation email.';
					
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
				
				$user = $this->user_m->signup($data);
				
				if($user){
					
					//$data['tmp_usr_act_key'] = $user['usr_act_key'];
					//$this->session->set_userdata($data);
					
					$mail = array(
										'usr_name' => $data['sgn_name'],
										'usr_email' => $data['sgn_email'],
										'act_link' => $this->data['site_url'].'user/account/activate?act='.$user['usr_act_key'],
										'subject' => 'Qaptured User Activation'
									);
					
					$this->_send_mail($mail, 'user_activation');
					
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