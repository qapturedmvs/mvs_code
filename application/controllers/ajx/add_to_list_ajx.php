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
					$mvs_id = (int) $this->input->post('id', TRUE);
					
					if($action === 'seen')
						$this->data['seen_result'] = ($mvs_id) ? $this->action_m->seen_movie(array('usr_id' => $this->user['usr_id'], 'mvs_id' => $mvs_id, 'action' => $action)) : 'no-movie';
						
					elseif($action === 'unseen')
						$this->data['seen_result'] = ($mvs_id) ? $this->action_m->seen_movie(array('usr_id' => $this->user['usr_id'], 'mvs_id' => $mvs_id, 'action' => $action)) : 'no-movie';
					
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
  
  }

?>