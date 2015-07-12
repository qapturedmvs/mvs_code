<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends User_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();

		}
    
    public function lists($slug = NULL){

			if($slug){

				$this->load->model('user_m');
				
				$data = array('usr_nick' => $slug, 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$this->data['the_user'] = $this->user_m->get_userbox($data);
				
				if($this->data['the_user']){
					
					$this->data['controls'] = array('page' => 'cl', 'cl_action' => TRUE, 'owner' => TRUE);
	
					if($this->data['the_user']['owner_fl'] === 0){
	
						$this->data['controls']['owner'] = FALSE;
						$this->data['controls']['cl_action'] = FALSE;
	
					}
		
					$this->data['subview'] = 'user/custom_list';
					$this->load->view('_main_body_layout', $this->data);
				
				}else{
				
					show_404();
					
				}
			
			}else{
				
				show_404();
				
			}
			
    }
		
		public function detail($slug = NULL){
			
			if($slug){
				
				$this->load->model('customlist_m');
				
				$data = array('slug' => $slug, 'login_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$cl = $this->customlist_m->get_customlist_detail($data);
				
				if($cl){
					
					$this->data['controls'] = array('page' => 'cld', 'seen_action' =>  'single', 'cld_action' => TRUE, 'owner' => TRUE);
					$this->data['the_user'] = array('usr_id' => $cl['usr_id'], 'usr_nick' => $cl['usr_nick'], 'usr_name' => $cl['usr_name'], 'usr_avatar' => $cl['usr_avatar'], 'usr_slogan' => $cl['usr_slogan'], 'lgn_flwr' => $cl['flw_id'], 'owner_fl' => $cl['owner_fl']);
					$this->data['list'] = array('list_id' => $cl['list_id'], 'list_title' => $cl['list_title'], 'pos_rate' => $cl['pos_rate'], 'neg_rate' => $cl['neg_rate'], 'rate_id' => $cl['rate_id'], 'rate_value' => $cl['rate_value'], 'list_data_count' => $cl['list_data_count']);
					
					if($this->data['the_user']['owner_fl'] === 0){
	
						$this->data['controls']['owner'] = FALSE;
						$this->data['controls']['cld_action'] = FALSE;
						
					}
	
					$this->data['subview'] = 'user/custom_list_detail';
					$this->load->view('_main_body_layout', $this->data);
					
				}else{
					
					show_404();
					
				}
			
			}else{
				
				show_404();
				
			}

    }
		
		public function seen($slug = NULL){		
			
			if($slug){
				
				$this->load->model('user_m');
				
				$data = array('usr_nick' => $slug, 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$this->data['the_user'] = $this->user_m->get_userbox($data);
				
				if($this->data['the_user']){
					
					$this->data['controls'] = array('page' => 'seen', 'seen_action' =>  'single', 'cld_action' => FALSE, 'owner' => TRUE);
					
					if($this->data['the_user']['owner_fl'] === 0)
						$this->data['controls']['owner'] = FALSE;
		
					$this->data['subview'] = 'user/seen';
					$this->load->view('_main_body_layout', $this->data);
				
				}else{
				
					show_404();
					
				}
			
			}else{
				
				show_404();
				
			}
			
		}
		
		public function watchlist($slug = NULL){
			
			if($slug){
				
				$this->load->model('user_m');
				
				$data = array('usr_nick' => $slug, 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$this->data['the_user'] = $this->user_m->get_userbox($data);
				
				if($this->data['the_user']){
					
					$this->data['controls'] = array('page' => 'wtc', 'seen_action' =>  'single', 'cld_action' => FALSE, 'owner' => TRUE);
					
					if($this->data['the_user']['owner_fl'] === 0)
						$this->data['controls']['owner'] = FALSE;
		
					$this->data['subview'] = 'user/watchlist';
					$this->load->view('_main_body_layout', $this->data);
				
				}else{
					
					show_404();
					
				}
			
			}else{
				
				show_404();
				
			}
			
		}
		
		public function applaud($slug = NULL){		
			
			if($slug){
				
				$this->load->model('user_m');
				
				$data = array('usr_nick' => $slug, 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$this->data['the_user'] = $this->user_m->get_userbox($data);
				
				if($this->data['the_user']){
					
					$this->data['controls'] = array('page' => 'applaud', 'seen_action' =>  'single', 'cld_action' => FALSE, 'owner' => TRUE);
					
					if($this->data['the_user']['owner_fl'] === 0)
						$this->data['controls']['owner'] = FALSE;
		
					$this->data['subview'] = 'user/applaud';
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