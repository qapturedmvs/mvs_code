<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();

		}
    
    public function lists($slug = NULL){

			if($slug){

				$this->load->model('user_custom_list_m');
				
				$this->data['controls'] = array('page' => 'cl', 'cl_action' => TRUE, 'owner' => TRUE);

				if((!$this->logged_in) || ($this->logged_in && $this->user['usr_nick'] !== $slug)){

					$this->data['the_user'] = $this->user_custom_list_m->get_user_from_slug($slug, $this->user['usr_id'], 'profile');
					$this->data['controls']['owner'] = FALSE;
					$this->data['controls']['cl_action'] = FALSE;
					
					if(!$this->data['the_user'])
						show_404();

				}
	
				$this->data['subview'] = 'user/custom_list';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
    }
		
		public function detail($slug = NULL){
			
			if($slug){
				
				$this->load->model('user_custom_list_m');
				
				$this->data['controls'] = array('page' => 'cld', 'seen_action' =>  'single', 'cld_action' => TRUE, 'owner' => TRUE);
				$cl = $this->user_custom_list_m->get_customlist_detail(array('slug' => $slug, 'login_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0));
				
				
				if(!$cl)
					show_404();
				
				$this->data['the_user'] = (object) array('usr_id' => $cl[0]['usr_id'], 'usr_nick' => $cl[0]['usr_nick'], 'usr_name' => $cl[0]['usr_name'], 'usr_avatar' => $cl[0]['usr_avatar'], 'usr_slogan' => $cl[0]['usr_slogan'], 'flw_id' => $cl[0]['flw_id']);
				$this->data['list'] = array('list_id' => $cl[0]['list_id'], 'list_title' => $cl[0]['list_title'], 'pos_rate' => $cl[0]['pos_rate'], 'neg_rate' => $cl[0]['neg_rate'], 'rate_id' => $cl[0]['rate_id'], 'rate_value' => $cl[0]['rate_value']);
				
				if((!$this->logged_in) || ($this->logged_in && $this->user['usr_nick'] !== $this->data['the_user']->usr_nick)){

					$this->data['controls']['owner'] = FALSE;
					$this->data['controls']['cld_action'] = FALSE;
					
				}else{
					
					unset($this->data['the_user']);
					
				}

				$this->data['subview'] = 'user/custom_list_detail';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}

    }
		
		public function seen($slug = NULL){		
			
			if($slug){
				
				$this->data['controls'] = array('page' => 'seen', 'seen_action' =>  'single', 'cld_action' => FALSE, 'owner' => TRUE);
				
				if((!$this->logged_in) || ($this->logged_in && $this->user['usr_nick'] !== $slug)){
					
					$this->load->model('seen_m');
					
					$this->data['the_user'] = $this->seen_m->get_user_from_slug($slug, $this->user['usr_id'], 'profile');
					$this->data['controls']['owner'] = FALSE;
					
					if(!$this->data['the_user'])
						show_404();
						
				}
	
				$this->data['subview'] = 'user/seen';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
		}
		
		public function watchlist($slug = NULL){
			
			if($slug){
				
				$this->data['controls'] = array('page' => 'wtc', 'seen_action' =>  'single', 'cld_action' => FALSE, 'owner' => TRUE);
				
				if((!$this->logged_in) || ($this->logged_in && $this->user['usr_nick'] !== $slug)){

					$this->load->model('watchlist_m');
					
					$this->data['the_user'] = $this->watchlist_m->get_user_from_slug($slug, $this->user['usr_id'], 'profile');
					$this->data['controls']['owner'] = FALSE;
					
					if(!$this->data['the_user'])
						show_404();
						
				}
	
				$this->data['subview'] = 'user/watchlist';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
		}
  
  }

?>