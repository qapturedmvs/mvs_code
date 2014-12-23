<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
			
		}
		
		public function index(){

			$vars = $this->_filter_qs($this->get_vars);
			$act = $this->_qs_compare($vars);
			$db_data['genres'] = $this->movie_m->_genres(NULL, 'result_array');
			$db_data['countries'] = $this->movie_m->_countries(NULL, 'result_array');
			$tables = $this->set_tables($db_data);
			$tables['mfy'] = array('min' => 1950, 'max' => 2014);
			$tables['mfr'] = array('min' => 1, 'max' => 10);
			$filters = $this->session->userdata('filters');

			if(isset($act['plus'])){
				$movies = $this->movie_m->_filters($act['current'], $this->filter_def);
				$filters = $this->_filter_filters($movies['data'], $act, $tables, $filters);
			}elseif(isset($act['minus'])){
				$filters = $this->_rebuild_filters($act, $filters);
			}else{
				$filters['old'] = $this->_set_tables($tables);
			}
			
			if(isset($filters['diff']))
				unset($filters['diff']);
				
			$this->data['tables'] = $tables;
			$this->data['filters'] = $filters;
			$this->data['subview'] = 'movie/list';
			//var_dump($filters);
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		// TEMP FUNCTION
		private function set_tables($data){
			
			$tables = array();
			
			foreach($data['genres']['data'] as $item){
				$tables['mfg'][$item['gnr_id']] = $item['gnr_title'];
			}
			
			foreach($data['countries']['data'] as $item){
				$tables['mfc'][$item['cntry_id']] = $item['cntry_title'];
			}
			
			return $tables;
			
		}
		
		// SET 'CURRENT' & 'OLD'
		private function _filter_qs($qs){
			
			$vars['old'] = $this->session->userdata('qs');
			$vars['current'] = array();
			
			if($qs){

				$vars['current']= filter_qs_fn($qs, $this->defF);
				
				if($vars['old'] != $vars['current'])
					$this->session->set_userdata(array('qs' => $vars['current']));

			}else{
				$this->session->unset_userdata('qs');
			}

			return $vars;
		}
		
		// COMPARE 'CURRENT' & 'OLD'
		private function _qs_compare($vars){
			
			$vars['plus'] = array();
			$vars['minus'] = array();
			
			if($vars['old'] != $vars['current']){ // SAYFA REFRESH Mİ OLMUŞ KONTROLÜ
				if($vars['old']){ // İLK GİDİLEN SAYFA MI KONTROLÜ
					$temp = '';
					
					foreach($vars['old'] as $key => $val){
						 if(isset($vars['current'][$key])){
							 if($val != $vars['current'][$key]){
									$temp = array_diff($vars['current'][$key], $val);
									
									if(count($temp) > 0)
										$vars['plus'][$key] = $temp;
										
									$temp = array_diff($val, $vars['current'][$key]);
									
									if(count($temp) > 0)
										$vars['minus'][$key] = $temp;
		
							 }
						 }else{
								if(count($val) > 0)
									$vars['minus'][$key] = $val;
						 }
					}
					
					foreach($vars['current'] as $key => $val){
						 if(!isset($vars['old'][$key]) && count($val) > 0){
								$vars['plus'][$key] = $val;
						 }
					}
				}else{
					$vars['plus'] = $vars['current'];
				}
			}
			
			if(!count($vars['minus'])) unset($vars['minus']);
			if(!count($vars['plus'])) unset($vars['plus']);
			
			return $vars;
			
		}
		
		public function _filter_filters($data, $vars, $tables, $fltrs){
			
			$normal = (count($vars['plus']) == 1) ? TRUE : FALSE;
			$filters['current'] = array('mfg' => array(), 'mfc' => array(), 'mfy' => array(), 'mfr' => array());
			$temp = '';
			
			foreach($data as $movie){
				
				if(!$normal || !isset($vars['plus']['mfg'])){
					if($movie->gnr_id != '' && $movie->gnr_id != '||'){ // DÜZGÜN DATA OLUNCA KALDIRILACAK
						$temp = explode('||', trim($movie->gnr_id, '|'));
						foreach($temp as $t){
							if(!in_array($t, $filters['current']['mfg']))
								array_push($filters['current']['mfg'], $t);
						}
					}
				}
				
				if(!$normal || !isset($vars['plus']['mfc'])){
					if($movie->cntry_id != '' && $movie->cntry_id != '||'){ // DÜZGÜN DATA OLUNCA KALDIRILACAK
						$temp = explode('||', trim($movie->cntry_id, '|'));
						foreach($temp as $t){
							if(!in_array($t, $filters['current']['mfc']))
								array_push($filters['current']['mfc'], $t);
						}
					}
				}
				
				if(!$normal || !isset($vars['plus']['mfy'])){
					if(!in_array($movie->mvs_year, $filters['current']['mfy']))
						array_push($filters['current']['mfy'], $movie->mvs_year);
				}
				
				if(!$normal || !isset($vars['plus']['mfr'])){
					if(!in_array($movie->mvs_rating, $filters['current']['mfr']))
						array_push($filters['current']['mfr'], $movie->mvs_rating);
				}
				
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
			
			if($normal){
				
				$temp = $fltrs;
				$filters['old'] = $fltrs['old'];
				
				if(isset($temp['diff']))
					$filters['diff'] = $temp['diff'];

				foreach($filters['current'] as $key => $val){
					if(!empty($filters['current'][$key])){
						foreach($vars['plus'] as $k => $v){
							if(count($v) == 1 && $key != $k){
								if($filters['old']){
									$temp[0] = array_diff($filters['old'][$key], $val);
									$temp[1] = array_diff($val, $filters['old'][$key]);
									if(count($temp[0]))
										$filters['diff'][$k.'-'.implode('', $v)][$key]['m'] = $temp[0];
										
									if(count($temp[1]))
										$filters['diff'][$k.'-'.implode('', $v)][$key]['p'] = $temp[1];
										
								}else{
									$temp[0] = array_diff($tables[$key], $val);
									
									if(count($temp[0]))
										$filters['diff'][$k.'-'.implode('', $v)][$key]['m'] = $temp[0];
										
								}
							}
	
							$filters['current'][$k] = ($filters['old']) ? $filters['old'][$k] : $tables[$k];
						}
					}
				}
			
			}else{
				$this->session->unset_userdata('filters');
			}
			
			$filters['old'] = $filters['current'];
			unset($filters['current']);

			$this->session->set_userdata(array('filters' => $filters));
			
			return $filters;
			
		}
		
		private function _rebuild_filters($vars, $filters){
			//var_dump($filters);
			if($filters){
				foreach($vars['minus'] as $key => $val){
					foreach($val as $value){
						if(isset($filters['diff'][$key.'-'.$value])){
							foreach($filters['diff'][$key.'-'.$value] as $k => $v){
								if(isset($filters['diff'][$key.'-'.$value][$k]['m']))
									array_push($filters['old'][$k], $filters['diff'][$key.'-'.$value][$k]['m']);
									
								if(isset($filters['diff'][$key.'-'.$value][$k]['p']))
									$filters['old'][$k] = array_diff($filters['old'][$k], $filters['diff'][$key.'-'.$value][$k]['p']);
							}
						}
					}
				}
			}
			
			$this->session->set_userdata(array('filters' => $filters));
			
			return $filters;
		}
		
		private function _set_tables($tables){
			
			$filters = array();
			
			foreach($tables as $key => $val){
				if($key != 'mfy' && $key != 'mfr')
					$filters[$key] = array_keys($val);
				else{
					foreach($val as $k => $v){
						$filters[$key][$k] = $v;
					}
				}
			}
			
			return $filters;
			
		}
	
	}

?>