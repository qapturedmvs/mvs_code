<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Password extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('user_m');
      
		}
		
		public function reset(){
			
			$db_data = $this->user_m->get_user_data($this->get_vars['act'], 'usr_act_key');
			
			if(isset($db_data['data']) && $db_data['data']->usr_act == 1){
				
				if(isset($inputs['pwr_submit']))
					$this->_reset_process($inputs, $db_data['data']->usr_id, 'user/account/password_reset_success');
				
			}else{
				
				redirect('', 'refresh');
				
			}
			
			$this->data['subview'] = 'user/account/password_reset';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		private function _reset_process($inputs, $usr_id, $successPage){
			
			$rules = $this->config->config['usr_password_reset'];
			$this->form_validation->set_rules($rules);
			unset($data['pwr_submit']);
			
			if($this->form_validation->run() === TRUE){

				$data = changePrefix($data, 'prw', 'usr');

				if($this->user_m->update_profile($usr_id, $data) === TRUE){
					
					redirect($successPage, 'refresh');
					
				}else{
					
					$this->data['password_reset_error'] = 'An error occured. Please try again later.';
					
				}
				
			}else{
				$this->data['password_reset_error'] = validation_errors();
			}
			
		}
  
  }

?>