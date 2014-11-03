<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/movie_m');
<<<<<<< HEAD
=======
		
		
>>>>>>> parent of 5685b4c... Movie detay
	}
	
	public function lister(){
		
<<<<<<< HEAD
		$this->data['movies'] = $this->movie_m->movies();
=======
		// Thumbs (Settings kısmındaki bir buttona bağlanacak
		//$this->_image_thumbs(FCPATH."data/movies/", 60, 100);
		
		$p = $this->uri->segment(4);
		$curPage = ($p != '') ? $p : 1;
		$linkCount = 10;
		$offset = ($curPage-1)*$this->movie_m->per_page;

		$this->data['offset'] = $offset;
		$this->data['movies'] = $this->movie_m->movies($offset);
		$this->data['paging'] = $this->movie_m->getPaging($curPage, $linkCount);
>>>>>>> parent of 5685b4c... Movie detay

		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
}