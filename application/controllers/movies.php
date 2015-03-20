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

			$this->data['controls'] = array('page' => 'movies', 'seen_action' => 'multi', 'cl_action' => FALSE);
			$this->data['vars'] = $vars;
			$this->data['tables'] = $tables;
			$this->data['subview'] = 'movie/list';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		// TEMP FUNCTION
		private function _set_tables($filter_def){
			
			$tables = array();
			
			foreach($filter_def['like'] as $key => $val)
				$tables[$key] = $this->cache_table_data($val[1], 'movie_m', array('id' => $val[0], 'title' => $val[2]));

			$tables['mfr']  = array('min' => 1, 'max' => 10);
			$tables['mfy']  = array('min' => 1950, 'max' => 2014);
			
			return $tables;
			
		}
	
	}

?>