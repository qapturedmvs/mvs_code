<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Backend_Controller {
	
	public function __construct(){
		parent::__construct();
	
		$this->load->model('admin/settings_m');
	
	}
	
	public function index($s = NULL){
		
		$rules = $this->settings_m->rules;
		$this->form_validation->set_rules($rules);
		$this->data['form_success'] = FALSE;
		
		if ($this->form_validation->run() == TRUE) {
			
			// Settings'deki yeni alanlar buradaki array'e, settings_m'deki rules array'ine ve mvs_adm_config dosyasına eklenmeli
			$temp = $this->settings_m->array_from_post(array('mvs_site_name', 'mvs_cache_expire'));
			$sets = array();

			foreach($temp as $key => $val)
				array_push($sets, array('adm_set_code' => $key, 'adm_set_value' => $val));

			if($this->settings_m->save_sets($sets))
				$this->data['form_success'] = TRUE;
		}
		
		$this->data['settings'] = $this->settings_m->settings();
		
		// Load view
		$this->data['subview'] = 'admin/settings/index';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	public function thumbs(){
		
		$rules = $this->settings_m->rules_thumb;
		$this->form_validation->set_rules($rules);
		$this->data['form_success'] = FALSE;
		
		if ($this->form_validation->run() == TRUE) {
				
			$sets = $this->settings_m->array_from_post(array('img_path', 'img_width', 'img_height'));
			
			if (file_exists($sets['img_path'])){
				$this->_image_thumbs($sets['img_path'], $sets['img_width'], $sets['img_height']);
				$this->data['form_success'] = TRUE;
			}

		}
	
		// Load view
		$this->data['subview'] = 'admin/settings/thumbs';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	//Thumb generate
	private function _image_thumbs($path, $width, $height){
			
		if (file_exists($path)){
			
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
			
		}else{
			
			return FALSE;
			
		}
	
	}
	
}