<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actor extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/actors_m');
		$this->seg_4 = $this->uri->segment(4);
	}
	
	public function lister(){
		
		$curPage = ($this->seg_4 != '') ? $this->seg_4 : 1;
		$linkCount = 10;
		$offset = ($curPage-1)*$this->actors_m->per_page;
		
		$this->data['actor_counts'] = (object)array('offset' => $offset, 'per_page' => $this->actors_m->per_page);
		$this->data['actors'] = $this->actors_m->actors($offset);
		$this->data['paging'] = $this->actors_m->getPaging($curPage, $linkCount, 'admin/actor/lister');
		//$this->data['casting'] = $this->actors_m->cast();

		// Load view
		$this->data['subview'] = 'admin/actor/list';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	public function detail(){
		
		$this->data['actors'] = $this->actors_m->actors(NULL, $this->seg_4);
		$this->data['casting'] = $this->actors_m->cast($this->seg_4);
		
		// Load view
		$this->data['subview'] = 'admin/actor/detail';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
}