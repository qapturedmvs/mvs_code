<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Avatar_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
      
		}
		
		public function index(){
			
			$inputs = $this->input->post(NULL, TRUE);
			$path = '/data/users';
			//var_dump($inputs);
			$config['image_library'] = 'imagemagick';
			$config['library_path'] = 'C:\\ImageMagick-6.6.5-Q16\\';
			$config['image_library'] = 'gd2';
			$config['source_image'] = $inputs['src'];
			$config['new_image'] = str_replace('_temp', '', $inputs['src']);
			$config['create_thumb'] = TRUE;
			$config['width'] = $inputs['w'];
			$config['height'] = $inputs['h'];
			$config['x_axis'] = $inputs['x'];
			$config['y_axis'] = $inputs['y'];
			
			$this->load->library('image_lib', $config);
			
			if (!$this->image_lib->crop()){
				
					$this->data['result'] = $this->image_lib->display_errors();
					
			}else{
				
				$this->image_lib->resize();
				$this->data['result'] = TRUE;
				
			}

			$this->load->view('results/_avatar_edit', $this->data);
			
		}
    
  
  }

?>