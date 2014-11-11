<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actor extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/actors_m');

	}
	
	public function lister($p = 1){
		
		//$curPage = ($this->seg_4 != '') ? $this->seg_4 : 1;
		//$linkCount = 10;
		$offset = ($p-1)*$this->actors_m->per_page;
		
		//$this->data['actor_counts'] = (object)array('offset' => $offset, 'per_page' => $this->actors_m->per_page);
		//var_dump($this->actors_m->actors($offset));
		$db_data = $this->actors_m->actors($offset);
		$this->data['actors'] = $db_data['data'];
		//$this->data['paging'] = $this->actors_m->getPaging($curPage, $linkCount, 'admin/actor/lister');
		$this->data['paging'] = $this->_get_paging($db_data['count'], $this->actors_m->per_page, 'admin/actor/lister', 4);
		//$this->data['casting'] = $this->actors_m->cast();

		// Load view
		$this->data['subview'] = 'admin/actor/list';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	public function detail($id){
		
		$this->data['actors'] = $this->actors_m->actors(NULL, $id);
		$this->data['casting'] = $this->actors_m->cast($id);
		
		// Load view
		$this->data['subview'] = 'admin/actor/detail';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
}