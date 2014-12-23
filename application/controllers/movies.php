<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables();
			$vars = $this->_set_vars($this->get_vars);
			
			if($this->get_vars)
				$filters = $this->_filter_filters($vars, $tables);
			
			var_dump($filters);
			
			
			$this->data['subview'] = 'movie/list';
			//$this->load->view('_main_body_layout', $this->data);
			
		}
		
		// TEMP FUNCTION
		private function _set_tables(){
			
			$tables = array();
			$db_data['genres'] = $this->movie_m->_genres(NULL, 'result_array');
			$db_data['countries'] = $this->movie_m->_countries(NULL, 'result_array');
			
			foreach($db_data['countries']['data'] as $item){
				$tables['mfc'][$item['cntry_id']] = $item['cntry_title'];
			}
			
			foreach($db_data['genres']['data'] as $item){
				$tables['mfg'][$item['gnr_id']] = $item['gnr_title'];
			}

			$tables['mfr'] = array('min' => 1, 'max' => 10);
			$tables['mfy'] = array('min' => 1950, 'max' => 2014);
			
			return $tables;
			
		}
		
		// VARS
		private function _set_vars($qs){
			
			$vars['old'] = $this->session->userdata('qs');
			
			if($qs){

				$vars['current'] = qs_filter($qs, $this->filter_def);
				
				if(count($vars['current']) > 0 && $vars['old'] != $vars['current']){
					
					$this->session->set_userdata(array('qs' => $vars['current']));
					
					if($vars['old']){
					
						$temp = '';
						
						foreach($vars['old'] as $key => $val){
							if(!isset($vars['current'][$key])){
									
								$vars['minus'][$key] = $val;
									
							}elseif($vars['current'][$key] != $val){
								
								$temp = array_diff($vars['current'][$key], $val);
									
								if(count($temp) > 0)
									$vars['plus'][$key] = $temp;
									
								$temp = array_diff($val, $vars['current'][$key]);
								
								if(count($temp) > 0)
									$vars['minus'][$key] = $temp;
								
							}
						}
						
						foreach($vars['current'] as $key => $val){
							 if(!isset($vars['old'][$key]))
									$vars['plus'][$key] = $val;
						}
					
					}else{
						$vars['plus'] = $vars['current'];
					}
					
				}
				else{
					unset($vars['current']);
				}

			}elseif($vars['old']){
					$this->session->unset_userdata('qs');
			}

			return $vars;
		}
		
		
		public function _filter_filters($vars, $tables){

			$movies = $this->movie_m->_filters((isset($vars['current'])) ? $vars['current'] : $vars['old'], $this->filter_def);
			$filters['old'] = $this->session->userdata('filters');
			$filters['current'] = array('mfg' => array(), 'mfc' => array(), 'mfy' => array(), 'mfr' => array());
			$temp = '';
			
			foreach($movies['data'] as $movie){
				
				if($movie->gnr_id != '' && $movie->gnr_id != '||'){ // DÜZGÜN DATA OLUNCA KALDIRILACAK
					$temp = explode('||', trim($movie->gnr_id, '|'));
					foreach($temp as $t){
						if(!in_array($t, $filters['current']['mfg']))
							array_push($filters['current']['mfg'], $t);
					}
				}
				
				if($movie->cntry_id != '' && $movie->cntry_id != '||'){ // DÜZGÜN DATA OLUNCA KALDIRILACAK
					$temp = explode('||', trim($movie->cntry_id, '|'));
					foreach($temp as $t){
						if(!in_array($t, $filters['current']['mfc']))
							array_push($filters['current']['mfc'], $t);
					}
				}
				
				if(!in_array($movie->mvs_year, $filters['current']['mfy']))
					array_push($filters['current']['mfy'], $movie->mvs_year);

				if(!in_array($movie->mvs_rating, $filters['current']['mfr']))
					array_push($filters['current']['mfr'], $movie->mvs_rating);

			}
			
			$temp = array();
			
			if(!empty($filters['current']['mfy'])){
				$temp['min'] = min($filters['current']['mfy']);
				$temp['max'] = max($filters['current']['mfy']);
				$filters['current']['mfy'] = $temp;
			}
			
			if(!empty($filters['current']['mfr'])){
				$temp['min'] = floor(min($filters['current']['mfr']));
				$temp['max'] = ceil(max($filters['current']['mfr']));
				$filters['current']['mfr'] = $temp;
			}
			
			$filters['old'] = $filters['current'];
			unset($filters['current']);

			$this->session->set_userdata(array('filters' => $filters));
			
			return $filters;
			
		}
		
	
	}

?>