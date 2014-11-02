<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends Backend_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/movie_m');
		$this->seg_4 = $this->uri->segment(4);
		
	}
	
	public function lister(){
		
		// Thumbs (Settings kısmındaki bir buttona bağlanacak
		//$this->_image_thumbs(FCPATH."data/movies/", 60, 100);
		
		$curPage = ($this->seg_4 != '') ? $this->seg_4 : 1;
		$linkCount = 10;
		$offset = ($curPage-1)*$this->movie_m->per_page;

		$this->data['offset'] = $offset;
		$this->data['movies'] = $this->movie_m->movies($offset);
		$this->data['paging'] = $this->movie_m->getPaging($curPage, $linkCount, 'admin/movie/lister');

		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
	public function detail(){
		
		$this->data['movie'] = $this->movie_m->movie($this->seg_4);
		$this->data['casts'] = $this->movie_m->getCastList($this->seg_4);
		$countries = $this->movie_m->countries();
		$genres = $this->movie_m->genres();
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

	}
	
}