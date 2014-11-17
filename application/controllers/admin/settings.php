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
			$temp = $this->settings_m->array_from_post(array('mvs_site_name', 'mvs_cache_expire', 'mvs_img_path', 'mvs_img_l_size', 'mvs_img_d_size'));
			$sets = array();

			foreach($temp as $key => $val)
				array_push($sets, array('adm_set_code' => $key, 'adm_set_value' => $val));

			if($this->settings_m->save_sets($sets))
				$this->data['form_success'] = TRUE;
		}
		
		$db_data = $this->settings_m->settings();
		$this->data['settings'] = $db_data['data'];
		
		// Load view
		$this->data['subview'] = 'admin/settings/index';
		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	public function thumbs(){
		
		$result = FALSE;
		
		if($this->get_vars['path'] && $this->get_vars['width'] && $this->get_vars['height'] ){				
		
			if(file_exists(FCPATH.$this->get_vars['path'])){
				$result = $this->_image_thumbs($this->get_vars['path'], $this->get_vars['width'], $this->get_vars['height']);
		
			}
		}
		
		return $result;
		
// 		$rules = $this->settings_m->rules_thumb;
// 		$this->form_validation->set_rules($rules);
// 		$this->data['form_success'] = NULL;
		
// 		if ($this->form_validation->run() == TRUE) {
			
// 			$sets = $this->settings_m->array_from_post(array('img_path', 'img_width', 'img_height'));
			
// 			if (file_exists(FCPATH.$sets['img_path'])){
// 				$this->data['form_success'] = $this->_image_thumbs($sets['img_path'], $sets['img_width'], $sets['img_height']);
// 			}

// 		}
	
// 		// Load view
// 		$this->data['subview'] = 'admin/settings/thumbs';
// 		$this->load->view('admin/_main_body_layout', $this->data);
	}
	
	//Thumb generate
	private function _image_thumbs($path, $width, $height){
		
		if (file_exists(FCPATH.$path)){
			
			$this->load->library('image_lib');
			$this->load->helper('directory');
			
			$path = FCPATH.str_replace("/", "\\", trim($path, "/"));
			$imgMap = directory_map($path, 0);
			$thumPath = $path."\\thumbs";
			if (!file_exists($thumPath)) mkdir($thumPath, 0755, true);
			$thumbMap = directory_map($thumPath, 0);
			$marker = "_".$width."X".$height."_";

			foreach($imgMap as $item){
		
				if(!is_array($item) && !in_array(str_replace(".jpg", $marker.".jpg", $item), $thumbMap)){
					
					$config['thumb_marker'] = $marker;
					$config['image_library'] = 'gd2';
					$config['source_image'] = $path."\\".$item;
					$config['new_image'] = $path."\\thumbs";
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
			
			return TRUE;
			
		}else{
			
			return FALSE;
			
		}
	
	}
	
	public function slug(){
		
		$this->data['movie_slugs'] = $this->settings_m->no_slug('mvs_movies', 'mvs_id', 'mvs_slug');
		$this->data['actor_slugs'] = $this->settings_m->no_slug('mvs_stars', 'str_id', 'str_slug');
		
		// Load view
		$this->data['subview'] = 'admin/settings/slugs';
		$this->load->view('admin/_main_body_layout', $this->data);
		
	}
	
	public function slug_gen($method = NULL){
		
		if($method != NULL){
				
			$this->load->helper('string');
				
			if($method == 'movies'){
					
				$table = 'mvs_movies';
				$key = 'mvs_slug';
				$cols = 'mvs_id';
					
			}else{
					
				$table = 'mvs_stars';
				$key = 'str_slug';
				$cols = 'str_id';
					
			}
				
			return $this->settings_m->set_slug($table, $key, $cols);

		}
		
	}
	
}