<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie extends Backend_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/movie_m');
		
		$curPage = (isset($this->uri->segment(4))) ? $this->uri->segment(4) : 1;
	}
	
	public function lister(){
		
		$total = $this->movie_m->data_count();
		$perPage = 100;
		$linkCount = 10;
		$offset = ($curPage-1)*$perPage;
		$this->data['movies'] = $this->movie_m->movies($offset);
		$this->data['paging'] = $this->_getPaging($total, $perPage, $curPage, $linkCount);

		// Load view
		$this->data['subview'] = 'admin/movie/list';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
}