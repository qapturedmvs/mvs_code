<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Avatar_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
      
		}
		
		public function index(){

			$inputs = $this->input->post(NULL, TRUE);
			$path = FCPATH.'data\users\\';
			$new_image = explode('_temp', $inputs['src']);
			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.$inputs['src'];
			$config['new_image'] = $path.$new_image[0].'.jpg';
			$config['maintain_ratio'] = FALSE;
			$config['width'] = $inputs['w'];
			$config['height'] = $inputs['h'];
			$config['x_axis'] = $inputs['x'];
			$config['y_axis'] = $inputs['y'];

			$this->load->library('image_lib', $config);
			
			if (!$this->image_lib->crop()){
				
				$this->data['result'] = $this->image_lib->display_errors();
					
			}else{
				
				$this->data['result'] = TRUE;
				
				unlink($path.$inputs['src']);
				
				if($this->user['usr_avatar'] == ''){
					
					$this->user_m->set_avatar($this->user['usr_id'], $new_image[0]);
					$this->session->set_userdata('usr_avatar', $new_image[0]);
					
				}
				
			}

			$this->load->view('results/_avatar_edit', $this->data);
			
		}
    
  
  }

?>