<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
      
		}
		
		public function index(){ show_404(); }
    
    public function check_nick($nick){
				
			if($this->logged_in){
				
				if($nick && ($this->data['nick'] = slugify(rawurldecode($nick))) !== '')
					$this->data['check_nick_result'] = $this->user_m->check_usr_unique_field('usr_nick', $this->data['nick'], $this->user['usr_id']);
				else
					$this->data['check_nick_result'] = 'no-nick';
				
			}else{
				
				$this->data['check_nick_result'] = 'no-user';
				
			}
		
			$this->load->view('results/_check_user_nick', $this->data);

		}
		
		public function get_ff_list($p = 1){
			
			if($this->get_vars){
				
				$data = array('usr_nick' => $this->get_vars['nick'], 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'type' => $this->get_vars['type'], 'offset' => $p);

				$users = $this->user_m->get_user_network($data);
				$users = $this->_users_loop($users);
				
				$json = (object) array();
		
				if($users){						
					$json->result = 'OK';
					$json->data = $users;
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
		
		public function follow_user(){

			if($this->logged_in){
				
				$vars = $this->input->post(NULL, TRUE);
				
				if($vars){
					
					$data = array('flwd_usr_id' => $vars['id'], 'flwr_usr_id' => $this->user['usr_id'], 'flw_id' => $vars['itm']);
					$this->data['result'] = $this->user_m->follow_user($data);
					
				}else{
					
					$this->data['result'] = 'no-data';
					
				}
				
			}else{
				
				$this->data['result'] = 'no-user';
				
			}
			
			$this->load->view('results/_follow_user', $this->data);
				
    }
  
  }

?>