<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Account extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('user_m');
      
		}
		
		public function success(){
			
			$usr_act_key = $this->session->userdata('tmp_usr_act_key');
			
			if($usr_act_key){
        $this->session->unset_userdata('tmp_usr_act_key');
				$this->data['mail_link'] = $this->data['site_url'].'user/account/activate?act='.$usr_act_key;
			}else{
				redirect('', 'refresh');
			}
			
			$this->data['subview'] = 'account/signup_success';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		public function activate(){
			
			$db_data = $this->user_m->get_user_data($this->get_vars['act'], 'usr_act_key');
			
			if(count($db_data['data']) && $db_data['data']->usr_act == 0){		
				$this->data['act'] = $this->user_m->activate_account($this->get_vars['act']);
			}elseif(count($db_data['data']) && $db_data['data']->usr_act == 1){
        $this->data['act'] = 'activatedBefore';
			}else{
				$this->data['act'] = 'noAccount';
			}
			
			$this->data['subview'] = 'account/account_activate';
			$this->load->view('_main_body_layout', $this->data);
			
		}
  
  }

?>