<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Comments_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();

		}
    
    public function index(){ show_404(); }
    
    public function movie_detail($p = 1){
      
			if($this->input->is_ajax_request()){
				
				$this->load->model('comments_m');
				
				$mvs_id = $this->get_vars['mvs_id'];
				$type = $this->get_vars['type'];
				$usr_id = ($type == 'myn') ? $this->user['usr_id'] : 0;
				$json = (object) array();
				$db_data = $this->comments_m->movie_comments_json($mvs_id, $usr_id, $p);
				
				if($db_data){
					
					$db_data['data'] = $this->_build_comment_tree($db_data['data']);

					$json->result = 'OK';
					$json->total_count = $db_data['total_count'];
					$json->data = $db_data['data'];
				}else{
					$json->result = 'FALSE';
					$json->data = '';
				}
	
				$data['json'] = json_encode($json);
				
				$this->load->view('json/main_json_view', $data);
			
			}else{
				
				show_404();
				
			}
      
    }
		
		public function custom_list($p = 1){
      
			if($this->input->is_ajax_request()){
				
				$this->load->model('comments_m');
				
				$mvs_id = $this->get_vars['list_id'];
				$type = $this->get_vars['type'];
				$usr_id = ($type == 'myn') ? $this->user['usr_id'] : 0;
				$json = (object) array();
				$db_data = $this->comments_m->movie_comments_json($mvs_id, $usr_id, $p);
				
				if($db_data){
					
					$db_data['data'] = $this->_build_comment_tree($db_data['data']);

					$json->result = 'OK';
					$json->total_count = $db_data['total_count'];
					$json->data = $db_data['data'];
				}else{
					$json->result = 'FALSE';
					$json->data = '';
				}
	
				$data['json'] = json_encode($json);
				
				$this->load->view('json/main_json_view', $data);
			
			}else{
				
				show_404();
				
			}
      
    }
		
		private function _build_comment_tree(Array $data, $parent = 0){ 
		 
			$tree = array();
			
			foreach ($data as $d){
				
				if ($d->act_ref_id == $parent){ 
					
					$children = $this->_build_comment_tree($data, $d->act_id);
					
					if (!empty($children))
						$d->reply = $children;
				
					$tree[] = $d;
				 
				} 
				
				if($parent === 0)
					$d->act_time = time_calculator($d->act_time);
				
			}
			 
			return $tree;
		}
		
		public function add_comment(){
      
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$this->load->model('action_m');
				
					$vars = $this->input->post(NULL, TRUE);
					$data = array('act_type_id' => (int) $vars['type'], 'act_text' => $vars['text'], 'usr_id' => $this->user['usr_id'], 'act_ref_id' => isset($vars['ref']) ? $vars['ref'] : 0);
					$col = '';

					switch((int) $vars['type']) {
						case 1:
								$col = '';
								break;
						case 2:
								$col = 'mvs_id';
								break;
						case 3:
								$col = 'act_ref_id';
								break;
						case 4:
								$col = 'list_id';
								break;
					}
					
					if($col !== '')
						$data[$col] = $vars['id'];
					
					$feed = $this->action_m->add_comment($data);
					
					if($feed){
						
						$this->data['feed'] = $feed;
						$this->data['comment_result'] = 'success';
						
					}else{
						
						$this->data['comment_result'] = 'error';
						
					}
				
				}else{
					
					$this->data['comment_result'] = 'no-user';
					
				}
				
				$this->load->view('json/comment_json', $this->data);
			
			}else{
				
				show_404();
				
			}
				
    }
  
  }

?>