<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_Customlist_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_custom_list_m');
      
		}
		
		public function index(){ show_404(); }
    
    public function list_lister(){
				
			$json = (object) array();
			$usr_id = (isset($this->get_vars['usr'])) ? $this->get_vars['usr'] : $this->user['usr_id'];
			$lists = $this->user_custom_list_m->get_lists($usr_id);
			
			if($lists){
				$json->result = 'OK';
				$json->total_count = $lists['total_count'];
				$json->data = $lists['data'];
			}else{
				$json->result = 'FALSE';
				$json->data = '';
			}
			
			$this->data['json'] = json_encode($json);
			
			$this->load->view('json/main_json_view', $this->data);
				
    }
		
		public function edit_list_detail($list_id = NULL){
				
			if($this->logged_in){
				
				if($list_id){
					
					$vars = $this->input->post(NULL, TRUE);
					
					$data = array('list_id' => $list_id, 'usr_id' => $this->user['usr_id'], 'list_title' => $vars['title'], 'list_order' => $vars['order'], 'list_remove' => (isset($vars['del'])) ? $vars['del'] : NULL);

					var_dump($data);
					//$this->data['ecl_result'] = $this->user_custom_list_m->edit_custom_list($data);
					
				}
					
			}else{
				
				$this->data['ecl_result'] = 'no-user';
				
			}
			
			//$this->load->view('results/_cl_edit_list', $this->data);

		}

		public function create_new_list($action){
				
			if($this->logged_in){
				
				$this->load->model('user_custom_list_m');

				$vars = $this->input->post(NULL, TRUE);
				$data = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['id'], 'list_title' => $vars['title'], 'list_slug' => gnrtSlug('list'));
				$this->data['lst_result'] = $this->user_custom_list_m->create_customlist($data);
				
			}else{
				
				$this->data['lst_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_create_new_list', $this->data);
			
		}
		
		public function delete_custom_list($list_id){
				
			if($this->logged_in){
				
				$this->load->model('user_custom_list_m');
				
				$vars = $this->input->post(NULL, TRUE);
				
				if(isset($vars['list'])){
					
					$data = array('list_id' => $list_id, 'usr_id' => $this->user['usr_id']);
					$this->data['lst_result'] = $this->user_custom_list_m->delete_customlist($data);
				
				}else{
					
					show_404();
					
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

			}else{
				
				$this->data['rate_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_rate_item', $this->data);

		}
  
  }

?>