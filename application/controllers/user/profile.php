<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Profile extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('user_m');
			$this->session_check();
      
		}
    
    public function index(){
			
			$inputs = $this->input->post(NULL, TRUE);
				
			// PROFILE FORM CONTROLS
			if(isset($inputs['prf_submit']))
				$this->_save_data($inputs);
			
			$db_data = $this->user_m->profile($this->usr_id);
			
			if($db_data)
				$this->data['user_data'] = $db_data['data'];
			
			$this->data['subview'] = 'user/profile';
			$this->load->view('_main_body_layout', $this->data);
      
    }
		
		private function _save_data($data){
			
			$rules = $this->config->config['usr_profile'];
			$this->form_validation->set_rules($rules);
			unset($data['prf_submit']);
			
			if($this->form_validation->run() === TRUE){
				
				if($data['prf_password'] === '' && $data['repassword'] === ''){
					unset($data['prf_password']);
					unset($data['repassword']);
				}

				$data = changePrefix($data, 'prf', 'usr');

				if($this->user_m->update_profile($this->usr_id, $data) === TRUE){
					$this->data['profile_error'] = 'Profile saved.';
				}else{
					$this->data['profile_error'] = 'An error occured. Please try again later.';
				}
			}else{
				$this->data['profile_error'] = validation_errors();
			}
			
		}
		
		public function _unique_email($email){
			
			$db_data = $this->user_m->check_usr($email, $this->usr_id);
			
			return $db_data;
		
		}
  
  }

?>