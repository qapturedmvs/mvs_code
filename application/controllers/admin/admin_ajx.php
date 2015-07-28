<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin_Ajx extends Backend_Controller
	{
		
		function __construct ()
		{
			parent::__construct();
			
			//if(!$this->input->is_ajax_request())
			//	show_404();
			
		}
		
		public function get_movie_cover($p = 1){
			
			$vars = $this->input->get(NULL, TRUE);
			$vars['f'] = (isset($vars['f'])) ? $vars['f'] : 'jpg';
			$vars['s'] = (isset($vars['s'])) ? $vars['s'] : 'huge';
			$start = ($this->security->xss_clean($p) - 1) * 8;
			$url = 'https://ajax.googleapis.com/ajax/services/search/images?v=1.0&as_filetype='.$vars['f'].'&imgsz='.$vars['s'].'&rsz=8&start='.$start.'&q='.urlencode($vars['q']);
			
			$this->data['json'] = file_get_contents($url);
			$this->load->view('json/main_json_view', $this->data);
			
		}
		
		public function get_cover_image($slug = NULL){
			
			if($slug){
				
				$this->load->library('image_lib');
				
				$image = $this->input->get('img', TRUE);
				$path = FCPATH.'data/covers/';
				$temp = $path.$slug.'_temp.jpg';
				$this->data['cover_result'] = FALSE;
				
				if(copy($image, $temp)){
				
					$config['image_library'] = 'gd2';
					$config['source_image'] = $temp;
					$config['new_image'] = $path.$slug.'.jpg';
					$config['width'] = 1920;
					$config['height'] = 1080;
				
					$this->image_lib->initialize($config);
				
					if (!$this->image_lib->resize()){
						
						$this->data['cover_result'] = $image.' -> '.$this->image_lib->display_errors();
					
					}else{
						
						$this->load->model('admin/movie_m');
						
						$this->data['cover_result'] = $this->movie_m->set_cover($slug);
						unlink($path.$slug.'_temp.jpg');
					
					}
				
				}
				
				
				$this->load->view('admin/results/_select_cover_image', $this->data);
				
			}else{
				
				show_404();
				
			}
			
		}

	}
	
?>