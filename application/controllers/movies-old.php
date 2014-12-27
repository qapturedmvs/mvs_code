<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler(TRUE);
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables();
			$vars = $this->_set_vars($this->get_vars);
			
			if(isset($vars['plus']) || isset($vars['minus'])){
				$filters = $this->_filter_filters($vars['current']);
				
				if(isset($vars['plus']) && !isset($vars['minus']) && count($vars['plus']) == 1)
					$filters = $this->_get_sel($filters, $vars['plus']);
				elseif(isset($vars['minus']) && !isset($vars['plus']) && count($vars['minus']) == 1)
					$filters = $this->_get_sel($filters, $vars['minus']);
					
			}else{
				
				$filters = $tables['filter'];
				
			}
			
			$this->session->set_userdata(array('filters' => $filters));

			$this->data['tables'] = $tables['table'];
			$this->data['filters'] = $filters;
			$this->data['subview'] = 'movie/lister';
			$this->load->view('_main_body_layout', $this->data);
			
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
						
						unset($temp);
					
					}else{
						
						foreach($vars['current'] as $key => $val){
									$vars['plus'][] = $key;
						}
						
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
			
			if(!empty($filters['mfy']))
				$filters['mfy'] = array('min' => min($filters['mfy']), 'max' => max($filters['mfy']));
			
			if(!empty($filters['mfr']))
				$filters['mfr'] = array('min' => floor(min($filters['mfr'])), 'max' => ceil(max($filters['mfr'])));
			
			return $filters;
			
		}
		
		private function _get_sel($filters, $vars){
			
			$temp = $this->session->userdata('filters');

			if(!$temp)
				$temp = $tables['filter'];
			
			foreach($vars as $var)
				$filters[$var] = $temp[$var];
				
			unset($temp);
			
			return $filters;
			
		}
	
	}

?>