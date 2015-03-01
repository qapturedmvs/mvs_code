<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();

		}
		
		public function _remap($method,$args){
		
			if (method_exists($this, $method))
				$this->$method($args);
			else
				$this->index($method,$args);
			
		}
    
    public function index($slug = NULL){
			
			if($this->uri->segment(3) != 'index'){
				
				if($slug !== NULL){
					
					$this->load->model('user_custom_list_m');
					
				}

				$this->data['subview'] = 'user/custom_list';
				$this->load->view('_main_body_layout', $this->data);
				
			}else{
				show_404();
			}
			
    }
		
		public function detail($slug = NULL){

			if(count($slug) > 0){
				
				$this->load->model('user_custom_list_m');
				
				$list = $this->user_custom_list_m->get_list_detail($slug[0], $this->user['usr_id']);
				
				if($list){
					
					// Kullanıcı, başka birinin listesini mi görüntülüyor?
					$this->data['controls'] = array('page' => 'custom', 'seen' => 'single', 'permission' => ($list->usr_id === $this->user['usr_id']) ? TRUE : FALSE);
					$this->data['list'] = $list;
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
			
			$this->data['the_user'] = (object)array();
			
			if(count($slug) > 0){
				$this->load->model('seen_m');
				
				$this->data['the_user'] = $this->seen_m->get_user_from_slug($slug[0]);
			}else
				$this->data['the_user']->usr_id = $this->user['usr_id'];
			
			if($this->data['the_user']->usr_id){
					
				// Kullanıcı, başka birinin listesini mi görüntülüyor?
				$this->data['controls'] = array('page' => 'seen', 'seen' =>  'single', 'permission' => FALSE);

			}else{
				
				show_404();
				
			}
			
			$this->data['subview'] = 'user/seen';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		public function watchlist($slug = NULL){
			
			if(isset($this->user['usr_id']))
				$this->data['the_user']['login_user'] = $this->user['usr_id'];
				
			elseif(count($slug) === 0)
				show_404();
			
			if(count($slug) > 0){
				$this->load->model('watchlist_m');
				
				$this->data['the_user']['view_user'] = $this->watchlist_m->get_user_from_slug($slug[0], $this->user['usr_id']);
			}

			$this->data['controls'] = array('page' => 'wtc', 'seen' =>  'single', 'permission' => FALSE);
			$this->data['subview'] = 'user/watchlist';
			$this->load->view('_main_body_layout', $this->data);
			
		}
  
  }

?>