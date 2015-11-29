<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		
		private $filter_defs;
		
		function __construct(){
			parent::__construct();
			
			$this->filter_defs = $this->filter_def;
			$this->load->model('movie_m');
			
		}
		
		public function index(){
			
			$tables = $this->_set_tables($this->filter_defs);
			$vars = qs_filter($this->get_vars, $this->filter_defs);

			//Movies Total Count
			$data = array('list_type' => 'ml', 'mfn' => (isset($vars['mfn'][0])) ? $vars['mfn'][0] : 0, 'mfu' => (isset($vars['mfu'][0])) ? 1 : 0, 'usr' => '', 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'list_id' => 0, 'where' => movies_where($vars, $this->filter_def));
			$this->data['total'] = $this->movie_m->movies_count($data);
			
			$this->data['controls'] = array('page' => 'movies', 'seen_action' => 'multi', 'cl_action' => FALSE);
			$this->data['vars'] = $vars;
			$this->data['tables'] = $tables;
			$this->data['subview'] = 'movie/list';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
		// TEMP FUNCTION
		private function _set_tables($filter_def){
			
			$tables = array();
			$tables['mfc'] = $this->cache_table_data('countries', 'movie_m', array('id' => 'cntry_id', 'title' => 'cntry_title'));
			$tables['mfg'] = $this->cache_table_data('genres', 'movie_m', array('id' => 'gnr_id', 'title' => 'gnr_title'));
			$tables['mfr']  = array('min' => 1, 'max' => 10);
			$tables['mfy']  = array('min' => 1950, 'max' => 2015);
			
			return $tables;
			
		}
		
		
	
	}

?>