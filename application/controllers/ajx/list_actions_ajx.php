<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class List_Actions_Ajx extends Ajx_Controller{
    
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
		
		public function create_new_list($action){
				
			if($this->logged_in){
				
				$this->load->model('user_custom_list_m');
				
				$this->data['action'] = $action;
				$vars = $this->input->post(NULL, TRUE);
				$data = array('action' => $action, 'usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['id'], 'list_title' => $vars['title'], 'list_slug' => gnrtSlug('list'));
				$this->data['lst_result'] = $this->user_custom_list_m->create_delete_list($data);
				
			}else{
				
				$this->data['lst_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_create_new_list', $this->data);
			
		}
		
		public function delete_custom_list(){
				
			if($this->logged_in){
				
				$this->load->model('user_custom_list_m');
				
				$vars = $this->input->post(NULL, TRUE);
				
				if(isset($vars['list'])){
					
					$data = array('action' => 'dcl', 'list_id' => $vars['list'], 'usr_id' => $this->user['usr_id']);
					$this->data['lst_result'] = $this->user_custom_list_m->create_delete_list($data);
				
				}else{
					
					$this->data['lst_result'] = 'no-list';
					
				}
				
			}else{
				
				$this->data['lst_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_delete_custom_list', $this->data);
			
		}
		
		public function add_remove_from_list($action){
				
			if($this->logged_in){
				
				$this->load->model('user_custom_list_m');
				
				$this->data['action'] = $action;
				$vars = $this->input->post(NULL, TRUE);
				$data = array('action' => $action, 'usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['mvs']);
				
				if($action === 'atcl')
					$data['list_id'] = $vars['id'];
				else
					$data['ldt_id'] = $vars['id'];
				
				$this->data['lst_result'] = $this->user_custom_list_m->add_remove_from_list($data);

			}else{
				
				$this->data['lst_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_add_remove_from_list', $this->data);

		}
		
		public function rate_customlist($list_id){
			
			if($this->logged_in){
				
				$data = array('usr_id' => $this->user['usr_id'], 'list_id' => $list_id, 'value' => $this->get_vars['val']);
				$this->data['rate_result'] = $this->user_custom_list_m->rate_customlist($data);
				
				$this->load->view('results/_rate_item', $this->data);
			
			}else{
				
				show_404();
				
			}

		}
		
  
  }

?>