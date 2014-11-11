<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends Backend_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/movie_m');
		
	}
	
	public function lister($p = NULL){
		
		// Thumbs (Settings k�sm�ndaki bir buttona ba�lanacak
		//$this->_image_thumbs(FCPATH."data/movies/", 60, 100);
		
		$curPage = ($p != '') ? $p : 1;
		$linkCount = 10;
		$offset = ($curPage-1)*$this->movie_m->per_page;

		$this->data['movie_counts'] = (object)array('offset' => $offset, 'per_page' => $this->movie_m->per_page);
		$this->data['movies'] = $this->movie_m->movies($offset);
		//$this->data['paging'] = $this->movie_m->getPaging($curPage, $linkCount, 'admin/movie/lister');
		$this->data['paging'] = $this->_get_paging($this->movie_m->data_count('mvs_movies'), $this->movie_m->per_page, 'admin/movie/lister', 4);

		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
	public function detail($id = NULL){
		
		//$this->output->cache($this->config->item('mvs_cache_expire'));
		$movie = $this->movie_m->movie($id);
		if($movie){
			$this->data['movie'] = $this->movie_m->movie($id);
			$this->data['casts'] = $this->movie_m->getCastList($id);
			$countries = $this->movie_m->_countries();
			$genres = $this->movie_m->_genres();
			$gnrs = array();
			$cntrs = array();
			
			foreach($genres as $genre)
				$gnrs[$genre->gnr_id] = $genre->gnr_title;
			
			foreach($countries as $country)
				$cntrs[$country->cntry_id] = $country->cntry_title;
			
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