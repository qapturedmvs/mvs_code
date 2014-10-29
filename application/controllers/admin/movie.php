<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/movie_m');
	}
	
	public function lister(){
		
		$this->data['movies'] = $this->movie_m->movies();

		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
}