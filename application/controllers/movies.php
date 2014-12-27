<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
			//$this->output->enable_profiler(TRUE);
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables();
			$vars = qs_filter($this->get_vars, $this->filter_def);
			$filter_col = array('mfg' => 'gnr_id', 'mfc' => 'cntry_id', 'mfy' => 'mvs_year', 'mfr' => 'mvs_rating');
			
			if($vars){
				$filters = $this->_get_unsel($vars, $filter_col, $tables['filter']);
			}else{
				$filters = $tables['filter'];
			}
			
			//var_dump($filters);

			$this->data['tables'] = $tables['table'];
			$this->data['filters'] = $filters;
			$this->data['subview'] = 'movie/list';
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
		
		private function _get_unsel($vars, $filter_col, $tables){
			
			$filters = array('mfc' => array(), 'mfg' => array(), 'mfr' => array(), 'mfy' => array());
			$unfils = array();
			
			foreach($filters as $key => $val){
				if(!isset($vars[$key]))
					$unfils[] = $key;
			}
			
			$movies = $this->movie_m->_filters($vars, $this->filter_def);
			$temp = '';
			
			foreach($movies['data'] as $movie){
				
				foreach($unfils as $u){
					$temp = $movie->{$filter_col[$u]};
					
					if($temp != '' && $temp != '||' && strpos($temp, '||')){
						
						$temp = explode('||', trim($temp, '|'));
						
						foreach($temp as $t){
							
							$filters[$u][] = $t;
 							
						}
						
					}elseif($temp != ''){
						
						$filters[$u][] = (int)trim($temp, '|');
						
					}
					
					if($u != 'mfy' && $u != 'mfr')
						$filters[$u] = array_filter(array_unique($filters[$u]));
					else
						$filters[$u] = array('min' => floor(min($filters[$u])), 'max' => ceil(max($filters[$u])));
				}
				
			}
			
			if(count($vars) > 1){
				$filters = $this->_build_filters($vars, $filters, $filter_col);
			}else{
				foreach($vars as $key => $val)
					$filters[$key] = $tables[$key];
			}
			
			return $filters;
			
		}
		
		private function _build_filters($vars, $filters, $filter_col){
			
			foreach($vars as $key => $val){
				
				$vars_t = $vars;
				
				unset($vars_t[$key]);
				
				$movies = $this->movie_m->_filters($vars_t, $this->filter_def);
				$temp = '';
				
				foreach($movies['data'] as $movie){
					
					$temp = $movie->{$filter_col[$key]};
					
					if($temp != '' && $temp != '||' && strpos($temp, '||')){
						
						$temp = explode('||', trim($temp, '|'));
						
						foreach($temp as $t){
								$filters[$key][] = (int)$t;
						}
						
					}elseif($temp != ''){
						
						$filters[$key][] = (int)trim($temp, '|');
						
					}
					
					if($key != 'mfy' && $key != 'mfr'){
						$filters[$key] = array_filter(array_unique($filters[$key]));
					}else{
						$filters['mfy'] = array('min' => min($filters['mfy']), 'max' => max($filters['mfy']));
						$filters['mfr'] = array('min' => floor(min($filters['mfr'])), 'max' => ceil(max($filters['mfr'])));
					}
					
				}
				
			}
			
			return $filters;
		
		}
	}


?>