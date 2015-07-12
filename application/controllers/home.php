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
				$cookie = FALSE;
				
				unset($data['lgn_ref']);
				unset($data['lgn_submit']);
				
				if(isset($data['lgn_token'])){
					
					$cookie = TRUE;
					$data['lgn_token'] = hash('sha512', random_string('alpha', 10).$data['lgn_email']);
					
				}else{
					
					$data['lgn_token'] = NULL;
					
				}
				
				$data['lgn_type'] = 'lgn';
				$data['lgn_time'] = date("Y-m-d H:i:s");

				$user = $this->user_m->login($data);

				if($user && $user['usr_act'] == 1){
					
					
					//$session = array(
					//	'usr_id' => $user['usr_id'],
					//	'usr_nick' => $user['usr_nick'],
					//	'usr_name' => $user['usr_name'],
					//	'usr_email' => $user['usr_email'],
					//	'usr_avatar' => $user['usr_avatar'],
					//	'usr_loggedin' => TRUE,
					//);
					//
					//if($cookie){
					//
					//	$cookie = array(
					//		'name' => 'mvs_lgn_token',
					//		'value' => $data['lgn_token'],
					//		'expire' => 31536000,
					//		'path'   => '/'
					//	);
					//
					//	$this->input->set_cookie($cookie);
					//	
					//}
					//	
					//$this->session->set_userdata($session);
					if($this->_build_session($user, $data['lgn_token'], $cookie))	
						redirect($ref, 'refresh');
									
				}elseif($user && $user['usr_act'] == 0){

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
				
				$nick = gnrtSlug('user');
				$password = hash('sha512', $data['sgn_password']);
				$usr_act_key = hash('sha1', $nick.time());
				$usr_data = array(
					'usr_nick' => $nick,
					'usr_name' => $data['sgn_name'],
					'usr_email' => $data['sgn_email'],
					'usr_password' => $password,
					'usr_act_key' => $usr_act_key,
					'usr_time' => date($this->config->item('mvs_db_time'))
				);
				
				$user = $this->user_m->user_auth('sp_signup', $usr_data);
				
				if($user){
					
					$this->data['mail'] = $user;
					//ACTIVATE LATER
					//$this->_send_mail($data['sgn_email'], 'Qaptured User Activation', $this->data, 'user_activation');
					
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