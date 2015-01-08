<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies2 extends Frontend_Controller{
		
		private $filter_defs;
		
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler(TRUE);
			$this->filter_defs = $this->filter_def;
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables($this->filter_defs);
			$vars = qs_filter($this->get_vars, $this->filter_defs);
			$filter_col = array('mfg' => 'gnr_id', 'mfc' => 'cntry_id', 'mfy' => 'mvs_year', 'mfr' => 'mvs_rating');
			$cache_id = get_cache_id($vars);
			
			if($vars){
				if(!$filters = $this->cache->get($cache_id)){
					$filters = $this->_get_unsel($vars, $filter_col, $tables['filter']);
					$this->cache->save($cache_id, $filters, 600);
				}
			}else{
				$filters = $tables['filter'];
			}

			$this->data['vars'] = $vars;
			$this->data['tables'] = $tables['table'];
			$this->data['filters'] = $filters;
			$this->data['subview'] = 'movie/list';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		// TEMP FUNCTION
		private function _set_tables($filter_def){
			
			$tables = array();
			
			foreach($filter_def['like'] as $key => $val){
				
				$db_data[$val[1]] = $this->movie_m->{$val[1]}();
				
				foreach($db_data[$val[1]] as $item){
					$tables['table'][$key][(int)$item[$val[0]]] = $item[$val[2]];
					$tables['filter'][$key][] = (int)$item[$val[0]];
				}
				
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
			
			$movies = $this->movie_m->_filters($vars, $this->filter_defs);
			$temp = '';
			
			foreach($movies['data'] as $movie){
				
				foreach($unfils as $u){
					$temp = $movie->{$filter_col[$u]};
					
					if($temp != '' && $temp != '||' && strpos($temp, '||')){
						
						$temp = explode('||', trim($temp, '|'));
						
						foreach($temp as $t){
							
							$filters[$u][] = (int)$t;
 							
						}
						
					}elseif($temp != ''){
						
						$filters[$u][] = (int)trim($temp, '|');
						
					}
					
					if($u != 'mfy' && $u != 'mfr'){
						$filters[$u] = array_filter(array_unique($filters[$u]));
						sort($filters[$u]);
					}else{
						$filters[$u] = array('min' => floor(min($filters[$u])), 'max' => ceil(max($filters[$u])));
					}
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
				
				$movies = $this->movie_m->_filters($vars_t, $this->filter_defs);
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
						sort($filters[$key]);
					}else{
						$filters[$key] = array('min' => floor(min($filters[$key])), 'max' => ceil(max($filters[$key])));
					}
					
				}
				
			}
			
			return $filters;
		
		}
	}


?>