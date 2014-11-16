<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actor extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/actors_m');

	}
	
	public function lister($p = 1){
		
		$offset = ($p-1)*$this->actors_m->per_page;
		$db_data = $this->actors_m->actors($offset);
		$this->data['actors'] = $db_data['data'];
		$this->data['paging'] = $this->_get_paging($db_data['total_count'], $this->actors_m->per_page, 'admin/actor/lister', 4);

		// Load view
		$this->data['subview'] = 'admin/actor/list';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	public function detail($id){
		
		$db_data = $this->actors_m->actors(0, $id);
		$this->data['actors'] = $db_data['data'];
		$this->data['casting'] = $this->actors_m->cast($id);

		// Load view
		$this->data['subview'] = 'admin/actor/detail';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
}