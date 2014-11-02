<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Backend_Controller {
	
	public function __construct(){
		parent::__construct();
	
		$this->load->model('admin/settings_m');
		$this->seg_4 = $this->uri->segment(4);
	
	}
	
	public function index(){
		
		$curPage = ($this->seg_4 != '') ? $this->seg_4 : 1;
		$this->data['settings'] = $this->settings_m->settings();
		
		// Load view
		$this->data['subview'] = 'admin/settings';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
}