<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
			//$this->output->enable_profiler(TRUE);
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables();
			//$vars = $this->_set_vars($this->get_vars);
			//$vars['current'] = qs_filter($qs, $this->filter_def);
			

			$filters = $tables['filter'];


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
	
	}

?>