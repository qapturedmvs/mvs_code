<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/movie_m');
	}
	
	public function lister(){
		
		$this->data['movies'] = $this->movie_m->movies(0);
		
		var_dump($this->data['movies']);
		
	}
	
}