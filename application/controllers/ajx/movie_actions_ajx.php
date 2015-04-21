<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Actions_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
      
		}
    
    public function index(){ show_404(); }
    
    public function seen_unseen_movie($action){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
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

		}
		
		public function mark_all_seen(){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
				$ids = $this->input->post('ids', TRUE);
				$data = array();
				
				foreach($ids as $id)
					$data[] = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $id);
				
				$this->data['seen_result'] = $this->action_m->seen_movie_multi($data);

			}else{
				
				$this->data['seen_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_seen_movie', $this->data);

		}
		
		public function add_remove_watchlist($action){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
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

		}
  
  }

?>