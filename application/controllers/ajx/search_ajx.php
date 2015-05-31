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
		
		public function suggest_users(){
			
			$data = array('keyword' => $this->get_vars['u'], 'login_user' => $this->user['usr_id'], 'offset' => 0, 'per_page' => 5);
			$results = FALSE;
		 
			if($data['keyword']){
				
				$results = $this->search_m->suggest_users($data);
				
				foreach($results as $key => $user){
				
					if($this->logged_in)
						$results[$key]['result_follow'] = ($user['result_follow'] === NULL) ? 0 : $user['result_follow'];
					
					$results[$key]['result_poster'] = ($user['result_poster'] === '') ? 'images/user.jpg' : $user['result_poster'];
					$results[$key]['result_me'] = ($user['result_id'] === $this->user['usr_id']) ? 1 : 0;
					
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
			
		}
		
		public function get_users($p = 1){
			
			$data = array('keyword' => $this->get_vars['u'], 'login_user' => $this->user['usr_id'], 'offset' => $p, 'per_page' => 25);
			$results = FALSE;
		 
			if($data['keyword']){
				$results = $this->search_m->find_users($data);				
				$results = $this->_users_search_loop($results);

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
			
		}
		
		private function _users_search_loop($results){
			
			$users = array();
			
			foreach($results as $key => $user){
				
				$users[$key] = (object) array();
				$users[$key]->usr_id = $user['result_id'];
				$users[$key]->usr_nick = $user['result_slug'];
				$users[$key]->usr_name = $user['result_title'];
				$users[$key]->usr_avatar = ($user['result_poster'] === '') ? 'images/user.jpg' : $user['result_poster'];
				$users[$key]->usr_me = ($user['result_id'] === $this->user['usr_id']) ? 1 : 0;
				$users[$key]->flw_id = ($user['result_follow'] === NULL) ? 0 : $user['result_follow'];
				
			}
			
			return $users;
			
		}
		
			
	}

?>