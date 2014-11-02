<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Backend_Controller extends MVS_Controller
	{
		
		public $data = array();
	
		function __construct ()
		{
			parent::__construct();	
			
			$this->load->model('admin/user_m');
			$this->load->helper(array('form', 'mvs_helper'));
			$this->load->library('form_validation');	

			// Login check
			$exception_uris = array('admin/user/login', 'admin/user/logout');
			
			if (in_array(uri_string(), $exception_uris) == FALSE) {
				if ($this->user_m->loggedin() == FALSE) {
					redirect('admin/user/login');
				}
			}
			
			// Loading mvs_adm_config file and admin settings table
			$this->config->load('mvs_adm_config');
			$this->load->model('admin/settings_m');
			
			// Set mvs_adm_config variables from db
			$sets = $this->settings_m->get();
			foreach($sets as $set){
				$this->config->set_item($set->adm_set_code, $set->adm_set_value);
			}
			
			// Default Variables
			$this->data['site_url'] = site_url();
			$this->data['current_url'] = current_url();

		}
		
		//Thumb generate
		public function _image_thumbs($path, $width, $height){
			
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