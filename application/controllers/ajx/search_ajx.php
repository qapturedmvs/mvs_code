<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('search_m');
		}
		
		public function index(){ show_404(); }
		
		public function lister($keyword = NULL){
			
			$json = (object) array();
			$results = ($keyword) ? $this->search_m->find_movies_stars($keyword) : FALSE;

			if($results){
				
				$json->result = 'OK';
				$json->data = $results;
			
			}else{
			
				$json->result = 'FALSE';
				$json->data = '';
			
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
			
		}
		
		public function suggest($keyword = NULL){
			
			$json = (object) array();
			$data = array('keyword' => $keyword, 'type' => 'both', 'offset' => 0, 'per_page' => 5);
			$results = ($keyword) ? $this->search_m->suggest_movies_stars($data) : FALSE;

			if($results){
				
				$json->result = 'OK';
				$json->data = $results;
			
			}else{
			
				$json->result = 'FALSE';
				$json->data = '';
			
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
			
		}
		
		
		//private function _movies($keyword, $limited){
		//    
		//  $db_data = $this->search_m->find_movies($keyword, $limited);
		//  
		//  if($db_data)
		//	return $db_data['data'];
		//  else
		//	return $db_data;
		//
		//}
		//
		//private function _stars($keyword, $limited){
		//  
		//  $db_data = $this->search_m->find_stars($keyword, $limited);
		//  
		//  if($db_data)
		//	return $db_data['data'];
		//  else
		//	return $db_data;
		//  
		//
		//}
		
		public function get_users($type = 'suggest'){
			
			$data = array('keyword' => $this->get_vars['u'], 'login_user' => $this->user['usr_id'], 'type' => 'suggest');
			$results = FALSE;
		 
			if($data['keyword']){
				$results = $this->search_m->find_users($data);
				$results['data'] = $this->users_loop($results['data']);
			}

			$json = (object) array();
	
			if($results){						
				$json->result = 'OK';
				$json->data = $results['data'];
			}else{
				$json->result = 'FALSE';
				$json->data = '';
			}
			
			$this->data['json'] = json_encode($json);
			
			$this->load->view('json/main_json_view', $this->data);
			
		}
		
			
	}

?>