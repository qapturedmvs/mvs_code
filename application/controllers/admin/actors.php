<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actors extends Backend_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/actors_m');
	}
	
	public function lister(){
		
		$this->data['actors'] = $this->actors_m->actors();
		$this->data['casting'] = $this->actors_m->cast();

		// Load view
		$this->data['subview'] = 'admin/actors/list';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	public function star(){
		
		$this->data['actors'] = $this->actors_m->actors();
		$this->data['casting'] = $this->actors_m->cast();

		// Load view
		$this->data['subview'] = 'admin/actors/star';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
}