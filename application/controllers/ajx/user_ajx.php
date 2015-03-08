<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
      
		}
    
    public function check_nick($nick){
      
			if($this->input->is_ajax_request()){
				
				if($this->logged_in){
					
					if($nick)
						$this->data['check_nick_result'] = $this->user_m->check_usr_unique_field('usr_nick', $nick, $this->user['usr_id']);
					else
						$this->data['check_nick_result'] = 'no-nick';
					
				}else{
					
					$this->data['check_nick_result'] = 'no-user';
					
				}
			
				$this->load->view('results/_check_user_nick', $this->data);
			
			}else{
				
				show_404();
				
			}

		}
  
  }

?>