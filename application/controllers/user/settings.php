<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Settings extends User_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->session_check();
			$this->load->model('user_m');
      
		}
    
    public function general(){

			$data = array('usr_id' => $this->user['usr_id'], 'usr_act_key' => '');
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
			
			$this->data['the_user'] = $this->user_m->get_user_data($data);
			$this->data['controls'] = array('page' => 'set', 'owner' => TRUE);
			$this->data['subview'] = 'user/settings/general';
			$this->load->view('_main_body_layout', $this->data);
      
    }
		
		public function avatar(){	
			
			//$this->data['the_user'] = array('avatar' => $this->user['usr_avatar'], 'slug' => $this->user['usr_nick']);
			$this->data['mode'] = 'upload';
			$hdn = $this->input->post('hdnAvatar', TRUE);
			
			if($hdn){
				
				$config['upload_path'] = './data/users';
				$config['file_name']  = ($this->user['usr_avatar'] != '') ? $this->user['usr_avatar'].'_temp' : 'qu_'.$this->user['usr_id'].'_'.hash('sha1', $this->user['usr_id']).'_temp';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']	= '300';
				$config['max_width']  = '400';
				$config['max_height']  = '400';
				$config['overwrite']  = TRUE;
				
				$this->load->library('upload', $config);
		
				$this->data['image'] = (!$this->upload->do_upload()) ? array('error' => $this->upload->display_errors()) : $this->upload->data();
				
				if(!isset($this->data['image']['error']))
					$this->data['mode'] = 'edit';
				
			}
			
			$this->data['subview'] = 'user/settings/avatar';
			$this->load->view('_main_body_layout', $this->data);
      
    }
		
		public function cover(){
			
			$this->data['mode'] = 'upload';
			$hdn = $this->input->post('hdnCover', TRUE);

			if($hdn){
				$config['upload'] = array(
					'upload_path' => './data/user-covers/temp',
					'file_name' => ($this->user['usr_cover'] != '') ? $this->user['usr_cover'] : 'qu_'.$this->user['usr_id'].'_'.hash('sha1', $this->user['usr_id']),
					'allowed_types' => 'jpg|jpeg|png',
					'max_size' => '2048',
					'max_width' => '3000',
					'max_height' => '3000',
					'overwrite' => TRUE
				);				
				
				$this->load->library('upload', $config['upload']);
				
				$this->data['image'] = (!$this->upload->do_upload()) ? array('error' => $this->upload->display_errors()) : $this->upload->data();
				
				if(!isset($this->data['image']['error']))
					$this->data['mode'] = 'edit';
			
			}
	
			$this->data['subview'] = 'user/settings/cover';
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
				
				if($data['city_id'] == 0){
					unset($data['prf_location']);
					unset($data['city_id']);
				}

				$data = changePrefix($data, 'prf', 'usr');
				
				if($this->user_m->update_profile($this->user['usr_id'], $data) === TRUE){
					
					$this->_update_session($data);
					$this->data['result'] = array('status' => 'success', 'info' => 'Profile saved');
					
				}else{
					
					$this->data['result'] = array('status' => 'error', 'info' => 'An error occured. Please try again later.');
					
				}
			}else{
				
				$this->data['result'] = array('status' => 'error', 'info' => validation_errors());
				
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