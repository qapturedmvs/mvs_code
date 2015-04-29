<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Comments_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();

		}
    
    public function index(){ show_404(); }
    
    public function movie($p = 1){
				
			$this->load->model('comments_m');
			
			$data = array('mvs_id' => $this->get_vars['mvs_id'], 'usr_id' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'type' => $this->get_vars['type'], 'p' => $p);
			$json = (object) array();
			$db_data = $this->comments_m->movie_comments_json($data);
			
			if($db_data){
				
				$db_data = $this->_build_comment_tree($db_data);

				$json->result = 'OK';
				$json->data = $db_data;
			}else{
				$json->result = 'FALSE';
				$json->data = '';
			}

			$this->data['json'] = json_encode($json);
			
			$this->load->view('json/main_json_view', $this->data);
      
    }
		
		public function custom_list($p = 1){
      
			$this->load->model('comments_m');
			
			$data = array('list_id' => $this->get_vars['list_id'], 'usr_id' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'type' => $this->get_vars['type'], 'p' => $p);
			$json = (object) array();
			$db_data = $this->comments_m->customlist_comments_json($data);
			
			if($db_data){
				
				$db_data = $this->_build_comment_tree($db_data);

				$json->result = 'OK';
				$json->data = $db_data;
			}else{
				$json->result = 'FALSE';
				$json->data = '';
			}

			$this->data['json'] = json_encode($json);
			
			$this->load->view('json/main_json_view', $this->data);
      
    }
		
		private function _build_comment_tree($data){ 
		
			$tree = array();

			foreach($data as $k => $d){
				
				if($d['feed_type'] == 'rf'){
					
					foreach($tree as $tk => $tv){
						
						if($tv['feed_id'] == $d['feed_ref_id'])
							$tree[$tk]['ref'][] = $this->_prepare_comment_data($d);
						
					}
					
				}else{
					
					$tree[] = $this->_prepare_comment_data($d);
					
				}
				
			}
			
			return $tree;
		}
		
		private function _prepare_comment_data($feed){
			
			$feed['feed_ago'] = time_calculator($feed['feed_time']);
			$feed['usr_avatar'] = ($feed['usr_avatar'] == '') ? 'images/user.jpg' : $feed['usr_avatar'];
			$feed['owner'] = ($feed['usr_id'] == $this->user['usr_id']) ? 1 : 0;
			
			return $feed;
			
		}
		
		public function add_comment(){
				
			if($this->logged_in){
				
				$this->load->model('comments_m');
			
				$vars = $this->input->post(NULL, TRUE);
				
				if(isset($vars['ref'])){
					
					$data = array('usr_id' => $this->user['usr_id'], 'act_ref_id' => $vars['ref'], 'act_text' => $vars['text'], 'act_spl_fl' => $vars['spl']);
					
				}else{
					
					$data = array('act_type_id' => (int) $vars['type'], 'act_text' => $vars['text'], 'act_spl_fl' => $vars['spl'], 'usr_id' => $this->user['usr_id'], 'act_ref_id' => 0);
					$col = '';

					switch((int) $vars['type']) {
						case 2:
								$col = 'mvs_id';
								break;
						case 4:
								$col = 'list_id';
								break;
					}
					
					$data[$col] = $vars['id'];
					
				}
				
				$this->data['comment_result'] = $this->comments_m->add_comment($data);
				
			}else{
				
				$this->data['comment_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_add_comment', $this->data);

    }
		
		public function edit_comment($act_id){
				
			if($this->logged_in){
				
				$this->load->model('comments_m');
			
				$vars = $this->input->post(NULL, TRUE);
				$data = array('usr_id' => $this->user['usr_id'], 'act_id' => $act_id, 'act_text' => $vars['text'], 'act_spl_fl' => $vars['spl']);
				$this->data['edit_result'] = $this->comments_m->edit_comment($data);
				
			}else{
				
				$this->data['edit_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_edit_comment', $this->data);

    }
		
		public function delete_comment($act_id){
			
			if($this->logged_in){
				
				$this->load->model('comments_m');

				$data = array('act_id' => $act_id, 'usr_id' => $this->user['usr_id']);
				$this->data['item'] = 'review';
				$this->data['delete_result'] = $this->comments_m->delete_comment($data);
				
			}else{
				
				$this->data['delete_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_delete_review', $this->data);
			
		}
  
  }

?>