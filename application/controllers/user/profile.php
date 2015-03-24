<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Profile extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->session_check();
			$this->output->enable_profiler();
			$this->load->model('user_m');
      
		}
    
    public function index(){
			
			$this->data['controls'] = array('page' => 'profile', 'owner' => TRUE);
			$user = $this->user_m->get_user_data($this->user['usr_id'], 'usr_id');
			$this->data['modified_data'] = FALSE;
			$inputs = $this->input->post(NULL, TRUE);
				
			// PROFILE FORM CONTROLS
			if(isset($inputs['prf_submit'])){
				
				$this->_save_data($inputs);
				unset($inputs['prf_password']);
				unset($inputs['repassword']);
				unset($inputs['prf_submit']);
				$this->data['modified_data'] = json_encode($inputs);

			}
			
			$this->data['the_user'] = $user['data'];
			$this->data['subview'] = 'user/profile';
			$this->load->view('_main_body_layout', $this->data);
      
    }
		
		private function _save_data($data){
			
			$rules = $this->config->config['usr_profile'];
			$this->form_validation->set_message('_unique_email', 'That email used in another account.');
			$this->form_validation->set_rules($rules);
			unset($data['prf_submit']);
			
			if($this->form_validation->run() === TRUE){
				
				if($data['prf_password'] === '' && $data['repassword'] === ''){
					unset($data['prf_password']);
					unset($data['repassword']);
				}

				$data = changePrefix($data, 'prf', 'usr');

				if($this->user_m->update_profile($this->user['usr_id'], $data) === TRUE){
					
					$this->_update_session($data);
					$this->data['profile_error'] = 'Profile saved.';
					
				}else{
					
					$this->data['profile_error'] = 'An error occured. Please try again later.';
					
				}
			}else{
				
				$this->data['profile_error'] = validation_errors();
				
			}
			
		}
		
		public function _unique_email($email){
			
			$db_data = $this->user_m->check_usr_unique_field('usr_email', $email, $this->user['usr_id']);
			
			return $db_data;
		
		}
		
		public function _unique_nick($nick){
			
			$db_data = $this->user_m->check_usr_unique_field('usr_nick', $nick, $this->user['usr_id']);
			
			return $db_data;
		
		}
		
		private function _update_session($data){
			
			unset($data['prf_password']);
			unset($data['repassword']);
			
			$this->session->set_userdata($data);
			
		}
  
  }

?>