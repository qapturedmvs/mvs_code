<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Backend_Controller {
	
	public function __construct(){
		parent::__construct();
	
		$this->load->model('admin/settings_m');
	
	}
	
	public function index($s = NULL){
		
		$this->data['settings'] = $this->settings_m->settings();
		
		// Load view
		$this->data['subview'] = 'admin/settings/index';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	public function thumbs(){
	
		// Load view
		$this->data['subview'] = 'admin/settings/thumbs';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	//Thumb generate
	private function _image_thumbs($path, $width, $height){
			
		$this->load->library('image_lib');
		$this->load->helper('directory');
			
		$path = trim("/", $path);
		$imgMap = directory_map(FCPATH.$path, 0);
		$thumPath = FCPATH.$path."/thumbs/";
		if (!file_exists($thumPath)) mkdir($thumPath, 0755, true);
		$thumbMap = directory_map($thumPath, 0);
	
		foreach($imgMap as $item){
	
			if(!is_array($item) && !in_array(str_replace(".jpg", "_thumb.jpg", $item), $thumbMap)){
				$config['image_library'] = 'gd2';
				$config['source_image'] = FCPATH.$path.$item;
				$config['new_image'] = FCPATH.$path."thumbs/";
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $width;
				$config['height'] = $height;
	
				$this->image_lib->initialize($config);
	
				if (!$this->image_lib->resize())
				{
					return "<p>".$item." -> ".$this->image_lib->display_errors()."</p>";
				}
	
				$this->image_lib->clear();
	
			}
	
		}
	
	}
	
}