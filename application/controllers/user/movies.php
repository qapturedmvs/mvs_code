<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();

		}
		
		//public function _remap($method,$args){
		//
		//	if (method_exists($this, $method))
		//		$this->$method($args);
		//	else
		//		$this->index($method,$args);
		//	
		//}
    
    public function lister($slug){

				if(count($slug) > 0){
					
					$this->load->model('user_custom_list_m');
					
					$this->data['controls'] = array('page' => 'cl', 'cl_action' => TRUE, 'owner' => TRUE);
					$this->data['the_user'] = $this->user_custom_list_m->get_user_from_slug($slug[0], $this->user['usr_id']);

					if(isset($this->user['usr_nick']) && $this->user['usr_nick'] !== $slug[0]){
	
						
						$this->data['controls']['owner'] = FALSE;
						$this->data['controls']['cl_action'] = FALSE;

					}
		
					$this->data['subview'] = 'user/custom_list';
					//$this->load->view('_main_body_layout', $this->data);
				
				}else{
					
					show_404();
					
				}
			
    }
		
		public function detail($slug){
			
			if(count($slug) > 0){
				
				$this->load->model('user_custom_list_m');
				
				$this->data['controls'] = array('page' => 'cld', 'seen_action' =>  'single', 'cld_action' => TRUE, 'owner' => TRUE);
				$this->data['the_user'] = $this->user_custom_list_m->get_user_from_slug($slug[0], $this->user['usr_id'], TRUE);
				
				if(isset($this->user['usr_id']) && $this->user['usr_id'] !== $this->data['the_user']->usr_id){

					$this->data['controls']['owner'] = FALSE;
					$this->data['controls']['cld_action'] = FALSE;
					
				}
	
				$this->data['subview'] = 'user/custom_list_detail';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}

    }
		
		public function seen($slug){		
			
			if(count($slug) > 0){
				
				$this->data['controls'] = array('page' => 'seen', 'seen_action' =>  'single', 'cld_action' => FALSE, 'owner' => TRUE);
				
				if(isset($this->user['usr_nick']) && $this->user['usr_nick'] !== $slug[0]){

					$this->load->model('seen_m');
					
					$this->data['the_user'] = $this->seen_m->get_user_from_slug($slug[0], $this->user['usr_id']);
					$this->data['controls']['owner'] = FALSE;
					
				}
	
				$this->data['subview'] = 'user/seen';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
		}
		
		public function watchlist($slug){
			
			if(count($slug) > 0){
				
				$this->data['controls'] = array('page' => 'wtc', 'seen_action' =>  'single', 'cld_action' => FALSE, 'owner' => TRUE);
				
				if(isset($this->user['usr_nick']) && $this->user['usr_nick'] !== $slug[0]){

					$this->load->model('watchlist_m');
					
					$this->data['the_user'] = $this->watchlist_m->get_user_from_slug($slug[0], $this->user['usr_id']);
					$this->data['controls']['owner'] = FALSE;
					
				}
	
				$this->data['subview'] = 'user/watchlist';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
		}
  
  }

?>