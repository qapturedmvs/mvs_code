<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('search_m');
		}
		
		public function index(){ show_404(); }
		
		public function lister($p = 1){
			
			$json = (object) array();
			$data = array('keyword' => $this->get_vars['q'], 'type' => 'both', 'offset' => $p, 'per_page' => 10);
			$results = array('all' => array(), 'movie' => array(), 'star' => array());
			
			if(isset($this->get_vars['type'])){
				$data['type'] = $this->get_vars['type'];
				$data['per_page'] = 50;
			}
		
			$results['all'] = $this->search_m->find_movies_stars($data);
			
			foreach($results['all'] as $k => $v){
				
				if($v['result_type'] == 'movie')
					$v['result_poster'] = ($v['result_poster'] == 1) ? getCoverPath($v['result_slug'], 'small') : 'images/placeHolder.jpg';
				
				$results[$v['result_type']][$k] = $v; 
				
			}
			
			unset($results['all']);

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
		
		public function suggest(){
			
			$keyword = $this->get_vars['q'];
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