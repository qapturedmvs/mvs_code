<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends Backend_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/movie_m');
		
	}
	
	public function lister($p = 1){
		
		$db_data = $this->movie_m->movies($p);
		$this->data['movie_counts'] = (object)array('offset' => $db_data['offset'], 'per_page' => $db_data['per_page']);
		$this->data['movies'] = $db_data['data'];
		$this->data['paging'] = $this->_get_paging($db_data['total_count'], $this->movie_m->per_page, 'admin/movie/lister', 4);
		$this->data['count'] = (object)array('total_count' => '');
	
		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
	public function covers($p = 1){
		
		$db_data = $this->movie_m->covers($p);
		$this->data['movie_counts'] = (object)array('offset' => $db_data['offset'], 'per_page' => $db_data['per_page']);
		$this->data['movies'] = $db_data['data'];
		$this->data['paging'] = $this->_get_paging($db_data['total_count'], 10000, 'admin/movie/covers', 4);
		$this->data['count'] = $this->movie_m->cover_count();

		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
	public function covered($p = 1){
		
		$db_data = $this->movie_m->covered($p);
		$this->data['movie_counts'] = (object)array('offset' => $db_data['offset'], 'per_page' => $db_data['per_page']);
		$this->data['movies'] = $db_data['data'];
		$this->data['paging'] = $this->_get_paging($db_data['total_count'], 500, 'admin/movie/covered', 4);
		$this->data['count'] = $this->movie_m->cover_count();

		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
	public function detail($id = NULL){
		
		if($id){
			$db_data = $this->movie_m->movie($id);
			$this->data['movie'] = $db_data['data'];
			$db_data = $this->movie_m->getCastList($id);
			$this->data['casts'] = $db_data['data'];
			$db_data = $this->movie_m->_countries(); 
			$countries = $db_data['data'];
			$db_data = $this->movie_m->_genres();
			$genres = $db_data['data'];
			$db_data = $this->movie_m->_langs();
			$langs = $db_data['data'];
			$gnrs = array();
			$cntrs = array();
			$lngs = array();
			
			foreach($genres as $genre)
				$gnrs[$genre->gnr_id] = $genre->gnr_title;
			
			foreach($countries as $country)
				$cntrs[$country->cntry_id] = $country->cntry_title;
				
			foreach($langs as $lang)
				$lngs[$lang->lang_id] = $lang->lang_title;
			
			$this->data['langs'] = $lngs;
			$this->data['countries'] = $cntrs;
			$this->data['genres'] = $gnrs;
			
			// Load view
			$this->data['subview'] = 'admin/movie/detail';
			$this->load->view('admin/_main_body_layout', $this->data);
		}else{
			show_404();
		}

	}
	
}