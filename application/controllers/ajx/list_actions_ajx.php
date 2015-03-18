<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class List_Actions_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('action_m');
      
		}
    
    public function index(){ show_404(); }
    
    public function seen_unseen_movie($action){

			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$this->data['action'] = $action;
					$id = $this->input->post('id', TRUE);
					$data = array('action' => $action, 'usr_id' => $this->user['usr_id']);
					
					if($action === 'seen')
						$data['mvs_id'] = $id;
					else
						$data['seen_id'] = $id;

					$this->data['seen_result'] = $this->action_m->seen_movie($data);
					
				}else{
					
					$this->data['seen_result'] = 'no-user';
					
				}
				
				$this->load->view('results/_seen_movie', $this->data);
			
			}else{
				
				show_404();
				
			}

		}
		
		public function mark_all_seen(){
			
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$ids = $this->input->post('ids', TRUE);
					$data = array();
					
					foreach($ids as $id)
						$data[] = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $id);
					
					$this->data['seen_result'] = $this->action_m->seen_movie_multi($data);

				}else{
					
					$this->data['seen_result'] = 'no-user';
					
				}
				
				$this->load->view('results/_seen_movie', $this->data);
			
			}else{
				
				show_404();
				
			}

		}
		
		public function add_remove_watchlist($action){
			
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$this->data['action'] = $action;
					$id = $this->input->post('id', TRUE);
					$data = array('action' => $action, 'usr_id' => $this->user['usr_id']);
					
					if($action === 'awtc')
						$data['mvs_id'] = $id;
					else
						$data['wtc_id'] = $id;
						
					$this->data['wtc_result'] = $this->action_m->add_remove_watchlist($data);
						
				}else{
					
					$this->data['wtc_result'] = 'no-user';
					
				}
				
				$this->load->view('results/_wtc_add_remove', $this->data);
			
			}else{
				
				show_404();
				
			}

		}
		
		public function create_new_list($action){
			
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$this->data['action'] = $action;
					$vars = $this->input->post(NULL, TRUE);
					$data = array('action' => $action, 'usr_id' => $this->user['usr_id'], 'list_title' => $vars['title'], 'list_slug' => gnrtSlug('list'));
						
					$this->data['lst_result'] = array('lst' => $this->action_m->create_delete_list($data));
					
					if(is_numeric($this->data['lst_result']['lst'])){
						unset($data);
						$data = array('action' => 'atcl', 'mvs_id' => $vars['id'], 'list_id' => $this->data['lst_result']['lst']);
						$this->data['lst_result']['ldt'] = $this->action_m->add_remove_from_list($data);
					}else{
						$this->data['lst_result'] = 'no-list';
					}
				}else{
					
					$this->data['lst_result'] = 'no-user';
					
				}
				
				$this->load->view('results/_cl_create_new_list', $this->data);
			
			}else{
				
				show_404();
				
			}
			
		}
		
		public function add_remove_from_list($action){
			
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$this->data['action'] = $action;
					$vars = $this->input->post(NULL, TRUE);
					$data = array('action' => $action, 'usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['mvs']);
					
					if($action === 'atcl')
						$data['list_id'] = $vars['id'];
					else
						$data['ldt_id'] = $vars['id'];
					
					$this->data['lst_result'] = $this->action_m->add_remove_from_list($data);

				}else{
					
					$this->data['lst_result'] = 'no-user';
					
				}
				
				$this->load->view('results/_cl_add_remove_from_list', $this->data);
			
			}else{
				
				show_404();
				
			}

		}
		
  
  }

?>