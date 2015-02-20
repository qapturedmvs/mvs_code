<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Add_To_List_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('action_m');
      
		}
    
    public function index(){
      
    }
    
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
			
			}else{
				
				$this->data['seen_result'] = FALSE;
				
			}
				
			$this->load->view('results/_seen_movie', $this->data);
			
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
			
			}else{
				
				$this->data['seen_result'] = FALSE;
				
			}
				
			$this->load->view('results/_seen_movie', $this->data);
			
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
			
			}else{
				
				$this->data['wtc_result'] = FALSE;
				
			}
				
			$this->load->view('results/_add_remove_watchlist', $this->data);
			
		}
		
		public function create_delete_custom_list($action){
			
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$this->data['action'] = $action;
					$vars = $this->input->post(NULL, TRUE);
					$data = array('action' => $action, 'usr_id' => $this->user['usr_id']);
					
					if($action === 'cncl')
						$data['list_title'] = $vars['title'];
					else
						$data['list_id'] = $vars['id'];
						
					$this->data['lst_result'] = $this->action_m->create_delete_list($data);
						
				}else{
					
					$this->data['lst_result'] = 'no-user';
					
				}
			
			}else{
				
				$this->data['lst_result'] = FALSE;
				
			}
				
			$this->load->view('results/_create_delete_custom_list', $this->data);
			
		}
		
		private function _add_to_custom_list($data){
			
		}
  
  }

?>