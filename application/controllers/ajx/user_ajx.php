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
			
			$data = array('action' => $this->get_vars['act'], 'nick' => $this->get_vars['nick'], 'p' => $p);

			if($data['nick'] && $data['action']){

				if($this->logged_in)
					$data['login_user'] = $this->user['usr_id'];

				$results = $this->user_m->get_user_network($data);
				$results['data'] = $this->users_loop($results['data']);
				
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
  
  }

?>