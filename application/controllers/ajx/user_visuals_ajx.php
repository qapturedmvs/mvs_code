<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_Visuals_Ajx extends Ajx_Controller{
    
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

			$this->load->view('results/_avatar_cover_edit', $this->data);
			
		}
		
		public function cover(){
				
				$inputs = $this->input->post(NULL, TRUE);,
				$path = FCPATH.'data\users-cover\\';
				$new_image = explode('_temp', $inputs['src']);
				$config['crop'] = array(
					'image_library' => 'gd2',
					'source_image' => $upload_data['file_path'].$new_image[0].'.jpg',
					'maintain_ratio' => FALSE,
					'width' => 1920
					'height' => 600,
					'x_axis' => '0',
					'y_axis' => '0'
				);
				
				$this->load->library('image_lib', $config);
				
				if (!$this->image_lib->crop()){

					$this->data['result'] = $this->image_lib->display_errors();
						
				}else{
					
					$this->data['result'] = TRUE;
					
					unlink($path.$inputs['src']);

					if($user[0]->usr_cover == '')
						$this->user_m->set_cover($this->user['usr_id'], $new_image[0]);
					
				}
					
				$this->load->view('results/_avatar_cover_edit', $this->data);
			
		}
    
  
  }

?>