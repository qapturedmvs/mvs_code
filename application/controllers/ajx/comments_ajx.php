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
				
				if(isset($db_data['data'])){
					
					foreach($db_data['data'] as $comment)
						$comment->act_time = time_calculator($comment->act_time);

					$json->result = 'OK';
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
  
  }

?>