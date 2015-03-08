<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search_Ajx extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('search_m');
		}
		
		public function index(){

			
		}
		
		public function lister($keyword = NULL){

			if($this->input->is_ajax_request()){
				
			  $type = NULL;
			  $limited = TRUE;
			  $results = array('status' => 'none');
			 
			  if($keyword){
					$keyword = $this->search_m->cleaner($keyword);
						 
					if($type == 'movie' || $type == NULL){
						$results['movies'] = $this->_movies($keyword, $limited);
						$results['status'] = ($type == NULL) ? 'both' : 'movie';
					}
					
					if($type == 'star' || $type == NULL){
						$results['stars'] = $this->_stars($keyword, $limited);
						$results['status'] = ($type == NULL) ? 'both' : 'star';
					}
			  }

				$json = (object) array();
		
				if($results){						
					$json->result = 'OK';
					$json->data = $results;
				}else{
					$json->result = 'FALSE';
					$json->data = '';
				}
				
				$this->data['json'] = json_encode($json);
				
				$this->load->view('json/main_json_view', $this->data);
			
			}else{
				
				show_404();
					
			}
			
		}
		
		
		private function _movies($keyword, $limited){
      
		  $db_data = $this->search_m->find_movies($keyword, $limited);
		  
		  if($db_data)
			return $db_data['data'];
		  else
			return $db_data;
		
		}
		
		private function _stars($keyword, $limited){
		  
		  $db_data = $this->search_m->find_stars($keyword, $limited);
		  
		  if($db_data)
			return $db_data['data'];
		  else
			return $db_data;
		  
		
		}
		
			
	}

?>