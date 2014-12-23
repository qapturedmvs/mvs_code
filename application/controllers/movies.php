<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		private $filter_def = array('like' => array('mfc' => 'cntry_id', 'mfg' => 'gnr_id'), 'between' => array('mfr' => 'mvs_rating', 'mfy' => 'mvs_year'), 'equal' => array('mfa' => 'aud_id'));
		
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables();
			$vars = $this->_set_vars($this->get_vars);
			
			var_dump($vars);
			
			
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
							 if(!isset($vars['old'][$key])){
									$vars['plus'][$key] = $val;
							 }
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
		
		
	
	}

?>