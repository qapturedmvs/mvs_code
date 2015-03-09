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
		
		public function get_ff_list($p = 1){
			
			$data = array('action' => $this->get_vars['act'], 'nick' => $this->get_vars['nick'], 'p' => $p);

			if($this->input->is_ajax_request() && $data['nick'] && $data['action']){

				if($this->logged_in)
					$data['login_user'] = $this->user['usr_id'];

				$results = $this->user_m->get_user_network($data);
				$results['data'] = $this->_users_loop($results['data']);
				
				$json = (object) array();
		
				if($results){						
					$json->result = 'OK';
					$json->data = $results['data'];
					$json->total = $results['total_count'];
				}else{
					$json->result = 'FALSE';
					$json->data = '';
				}
				
				$this->data['json'] = json_encode($json);
			
				$this->load->view('json/main_json_view', $this->data);
			
			}else{
				
				show_404();
				
			}
			
		}
		
		private function _users_loop($users){
			
			foreach($users as $user){
				
				$user->usr_avatar = ($user->usr_avatar === '') ? 'images/user.jpg' : $user->usr_avatar;
				$user->flw_id = ($user->flw_id === NULL) ? 0 : $user->flw_id;
				
				if($user->usr_id === $this->user['usr_id'])
					$user->me = TRUE;
				
			}
			
			return $users;
			
		}
  
  }

?>