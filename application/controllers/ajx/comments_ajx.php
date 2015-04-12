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
		
		private function _build_comment_tree(Array $data){ 
		
			$tree = array();
			
			foreach($data as $ck => $cv){
				
				$cv['feed_ago'] = time_calculator($cv['feed_time']);
				$cv['usr_avatar'] =  ($cv['usr_avatar'] == '') ? 'images/user.jpg' : $cv['usr_avatar'];
				$cv['owner'] = ($cv['usr_id'] == $this->user['usr_id']) ? 1 : 0;
				
				if($cv['feed_type'] === 'rf'){
					
					foreach($data as $pk => $pv){
						
						if($pv['feed_type'] === 'rv' && $pv['feed_id'] == $cv['feed_ref_id']){

							if(isset($tree[$pk])){
								
								$tree[$pk]['ref'][] = $cv;
								
							}else{
							
								$pv['ref'][] = $cv;
								$tree[$pk] = $pv;
							
							}
							
							$tree[$pk]['feed_ago'] = time_calculator($tree[$pk]['feed_time']);		
							$tree[$pk]['usr_avatar'] =  ($tree[$pk]['usr_avatar'] == '') ? 'images/user.jpg' : $tree[$pk]['usr_avatar'];
							$tree[$pk]['owner'] = ($tree[$pk]['usr_id'] == $this->user['usr_id']) ? 1 : 0;
							
						}
						
					}
					
				}else{
					
					if(!isset($tree[$ck]))
						$tree[$ck] = $cv;
					
				}
				
			}
			
			ksort($tree);
			
			return $tree;
		}
		
		public function add_comment(){
				
			if(isset($this->user['usr_id'])){
				
				$this->load->model('action_m');
			
				$vars = $this->input->post(NULL, TRUE);
				
				if(isset($vars['ref'])){
					
					$data = array('usr_id' => $this->user['usr_id'], 'act_ref_id' => $vars['ref'], 'act_text' => $vars['text']);
					
				}else{
					
					$data = array('act_type_id' => (int) $vars['type'], 'act_text' => $vars['text'], 'usr_id' => $this->user['usr_id'], 'act_ref_id' => 0);
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
				
    }
  
  }

?>