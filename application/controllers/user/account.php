<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Account extends User_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('user_m');
      
		}
		
		public function success(){
			
//			$usr_act_key = $this->session->userdata('tmp_usr_act_key');
//			
//			if($usr_act_key){
//				
//        $this->session->unset_userdata('tmp_usr_act_key');
//				$this->data['mail_link'] = $this->data['site_url'].'user/account/activate?act='.$usr_act_key;
//				
//			}else{
//				
//				redirect('', 'refresh');
//				
//			}
			
			$this->data['subview'] = 'user/account/signup_success';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		public function activate(){
			
			$act = $this->get_vars['act'];
			
			if($act){
				
				$data = array('usr_act_key' => $act);
				$this->data['act'] = $this->user_m->activate_account($data);

				$this->data['subview'] = 'user/account/account_activate';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
		}
  
  }

?>