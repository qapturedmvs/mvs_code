<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Backend_Controller extends MVS_Controller
	{
		
		public $data = array();
	
		function __construct ()
		{
			parent::__construct();
			
			$this->config->load('mvs_adm_config');
			$this->load->model('admin/settings_m');
			$this->load->model('admin/user_m');
			$this->load->helper(array('form', 'mvs_helper'));
			$this->load->library('form_validation');
			
			// Set mvs_adm_config variables from db
			$sets = $this->settings_m->get();
			foreach($sets as $set){
				$this->config->set_item($set->adm_set_code, $set->adm_set_value);
			}

			// Default Variables
			$this->data['site_url'] = site_url();
			$this->data['current_url'] = current_url();

			// Login check
			$exception_uris = array('admin/user/login', 'admin/user/logout');
			
			if (in_array(uri_string(), $exception_uris) == FALSE) {
				if ($this->user_m->loggedin() == FALSE) {
					redirect('admin/user/login');
				}
			}

		}
		
		//Thumb generate
		public function _image_thumbs($path, $width, $height){
			
			$this->load->library('image_lib');
			$this->load->helper('directory');
			
			$imgMap = directory_map($path, 0);
			if(substr($path, -1) == "/") $thumPath = $path."thumbs/"; else $thumPath = $path."/thumbs/";
			if (!file_exists($thumPath)) mkdir($thumPath, 0755, true);
			$thumbMap = directory_map($thumPath, 0);
		
			foreach($imgMap as $item){
		
				if(!is_array($item) && !in_array(str_replace(".jpg", "_thumb.jpg", $item), $thumbMap)){
					$config['image_library'] = 'gd2';
					$config['source_image'] = $path.$item;
					$config['new_image'] = $path."thumbs/";
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