<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Password extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('user_m');
      
		}
		
		public function forget(){
			
			$inputs = $this->input->post(NULL, TRUE);
			$this->data['pwf_result'] = '';
			
			if(isset($inputs['pwf_submit'])){

				$rules = $this->config->config['usr_password_forget'];
        $this->form_validation->set_rules($rules);
				unset($inputs['pwf_submit']);
				
				if($this->form_validation->run() === TRUE){
					
					$account = $this->user_m->forget_password($inputs['pwf_email']);
					
					if($account){
						
						$this->data['mail'] = $account['data'];

						$this->_send_mail($account['data']->usr_email, 'Qaptured Forgotten Password', $this->data, 'user_password_forget');
						//$this->data['mail_link'] = $this->data['site_url'].'user/password/reset?act='.$account['data']->usr_act_key;
						$this->data['pwf_result'] = 'success';
						
					}else{
						
						$this->data['pwf_result'] = 'no-user';
						
					}
					
				}else{
					
					$this->data['pwf_result'] = validation_errors();
					
				}
				
			}
			
			$this->data['subview'] = 'user/account/password_forget';
      $this->load->view('_main_body_layout', $this->data);
			
		}
		
		public function reset(){
			
      $this->data['act'] = $this->get_vars['act'];
      
      if($this->data['act']){
        
        $db_data = $this->user_m->get_user_data($this->get_vars['act'], 'usr_act_key');
        $this->data['pwr_result'] = '';
        
        if(isset($db_data['data']) && $db_data['data']->usr_act == 1){
          
          $inputs = $this->input->post(NULL, TRUE);
          
          if(isset($inputs['pwr_submit'])){
            
            $rules = $this->config->config['usr_password_reset'];
            $this->form_validation->set_rules($rules);
            unset($inputs['pwr_submit']);

            if($this->form_validation->run() === TRUE){
      
              $inputs = changePrefix($inputs, 'pwr', 'usr');
      
              if($this->user_m->reset_password($db_data['data']->usr_id, $inputs) === TRUE){
                
                $this->data['pwr_result'] = 'success';
                
              }else{
                
                $this->data['pwr_result'] = 'An error occured. Please try again later.';
                
              }
              
            }else{
              
              $this->data['pwr_result'] = validation_errors();
              
            }
            
          }
          
          $this->data['subview'] = 'user/account/password_reset';
          $this->load->view('_main_body_layout', $this->data);
  
        }else{
          
          show_404();
          
        }

      }else{
        
        show_404();
        
      }
			
		}

  }

?>