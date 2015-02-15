<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Comments_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('comments_m');
      
		}
    
    public function index(){
      
    }
    
    public function movie_detail($p = 1){
      
			if($this->input->is_ajax_request()){
				
				$mvs_id = $this->get_vars['mvs_id'];
				$type = $this->get_vars['type'];
				$usr_id = ($type == 'myn') ? $this->user['usr_id'] : NULL;
				$per_page = 20;
				$json = (object) array();
				$p = $this->comments_m->cleaner($p);
				$offset = ($p-1) * $per_page;
				$db_data = $this->comments_m->movie_comments_json($mvs_id, $usr_id, $offset);
				
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
			
			}else{
				
				$data['json'] = FALSE;
				
			}
			
      $this->load->view('json/movie_comments_json', $data);
      
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
  
  }

?>