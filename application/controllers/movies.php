<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
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
			$filters = $tables['filter'];

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
	
	}

?>