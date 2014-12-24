<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables();
			$vars = qs_filter($this->get_vars, $this->filter_def);
			$history['filters'] = $this->session->userdata('filters');
			$history['vars'] = $this->_set_vars($vars);
			
			if($vars){
				$filters = $this->_filter_filters($vars);
				
				if(count($vars) == 1)
					$filters = $this->_get_sel($filters, $vars, $tables['filter']);
					
			}else{
				
				$filters = $tables['filter'];
				
			}
			
			$this->session->set_userdata(array('filters' => $filters));
			$this->session->set_userdata(array('vars' => $vars));
			
			var_dump($vars);
			$this->data['tables'] = $tables['table'];
			$this->data['filters'] = $filters;
			$this->data['subview'] = 'movie/list';
			//$this->load->view('_main_body_layout', $this->data);
			
		}
		
		// TEMP FUNCTION
		private function _set_tables(){
			
			$tables = array();
			$db_data['genres'] = $this->movie_m->_genres(NULL, 'result_array');
			$db_data['countries'] = $this->movie_m->_countries(NULL, 'result_array');
			
			foreach($db_data['countries']['data'] as $item){
				$tables['table']['mfc'][(int)$item['cntry_id']] = $item['cntry_title'];
				$tables['filter']['mfc'][] = (int)$item['cntry_id'];
			}
			
			foreach($db_data['genres']['data'] as $item){
				$tables['table']['mfg'][(int)$item['gnr_id']] = $item['gnr_title'];
				$tables['filter']['mfg'][] = (int)$item['gnr_id'];
			}

			$tables['table']['mfr'] = $tables['filter']['mfr'] = array('min' => 1, 'max' => 10);
			$tables['table']['mfy'] = $tables['filter']['mfy'] = array('min' => 1950, 'max' => 2014);
			
			return $tables;
			
		}
		
		// VARS
		private function _set_vars($vars){
			
			$vars['old'] = $this->session->userdata('qs');
			
			if($vars){

				$vars['current'] = $vars;
				
				if(count($vars['current']) > 0 && $vars['old'] != $vars['current']){
					
					$this->session->set_userdata(array('qs' => $vars['current']));
					
					if($vars['old']){
					
						$temp = '';
						
						foreach($vars['old'] as $key => $val){
							if(!isset($vars['current'][$key])){
									
								$vars['minus'][] = $key;
									
							}elseif($vars['current'][$key] != $val){
								
								$temp = array_diff($vars['current'][$key], $val);
									
								if(count($temp) > 0)
									$vars['plus'][] = $key;
									
								$temp = array_diff($val, $vars['current'][$key]);
								
								if(count($temp) > 0)
									$vars['minus'][] = $key;
								
							}
						}
						
						foreach($vars['current'] as $key => $val){
							 if(!isset($vars['old'][$key]))
									$vars['plus'][] = $key;
						}
					
					}else{
						$vars['plus'] = $vars['current'];
					}
					
				}else{
					unset($vars['current']);
				}

			}elseif($vars['old']){
					$this->session->unset_userdata('qs');
			}

			return $vars;
		}
		
		private function _filter_filters($vars){

			$movies = $this->movie_m->_filters($vars, $this->filter_def);
			$filters = array('mfc' => array(), 'mfg' => array(), 'mfr' => array(), 'mfy' => array());
			$temp = '';
			
			foreach($movies['data'] as $movie){
				
				if($movie->gnr_id != '' && $movie->gnr_id != '||'){ // DÜZGÜN DATA OLUNCA KALDIRILACAK
					$temp = explode('||', trim($movie->gnr_id, '|'));
					foreach($temp as $t){
						if(!in_array($t, $filters['mfg']))
							$filters['mfg'][] = (int)$t;
					}
				}
				
				if($movie->cntry_id != '' && $movie->cntry_id != '||'){ // DÜZGÜN DATA OLUNCA KALDIRILACAK
					$temp = explode('||', trim($movie->cntry_id, '|'));
					foreach($temp as $t){
						if(!in_array($t, $filters['mfc']))
							$filters['mfc'][] = (int)$t;
					}
				}
				
				$filters['mfy'][] = (int)$movie->mvs_year;
				$filters['mfr'][] = (int)$movie->mvs_rating;

			}
			
			$temp = array();
			
			if(!empty($filters['mfy'])){
				$temp['min'] = min($filters['mfy']);
				$temp['max'] = max($filters['mfy']);
				$filters['mfy'] = $temp;
			}
			
			if(!empty($filters['mfr'])){
				$temp['min'] = floor(min($filters['mfr']));
				$temp['max'] = ceil(max($filters['mfr']));
				$filters['mfr'] = $temp;
			}
			
			return $filters;
			
		}
		
		private function _get_sel($filters, $vars, $tables){
			
			foreach($vars as $key => $val)
				$filters[$key] = $tables[$key];
			
			return $filters;
			
		}
	
	}

?>