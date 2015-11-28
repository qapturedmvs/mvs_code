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
		
		public function get_actor_photo(){
			
			$vars = $this->input->get(NULL, TRUE);
			
			if($vars){
				
				$name = $vars['q'];
				$acctKey = 'TyO2K6KtMtph6u6eB16/teEtqPm8eUzpPIlV6J6pws0';
				$query = urlencode("'{$name}'");
				$requestUri = 'https://api.datamarket.azure.com/Bing/Search/Image?$format=json&Query='.$query.'&Options=%27DisableLocationDetection%27&Adult=%27Strict%27&ImageFilters=%27Size%3AMedium%2BAspect%3ATall%2BStyle%3APhoto%2BFace%3AFace%27';
				
				$auth = base64_encode("$acctKey:$acctKey");
				$data = array(
					'http' => array(
					'request_fulluri' => true,
					'ignore_errors' => true,
					'header' => "Authorization: Basic $auth")
				);
		
				$context = stream_context_create($data);
				$this->data['json'] = file_get_contents($requestUri, 0, $context);
				
			}

			$this->load->view('json/main_json_view', $this->data);
			
		}
		
		public function choose_actor_photo($slug = NULL){
			
			$vars = $this->input->get(NULL, TRUE);
			
			if($slug && $vars){
				
				$this->load->library('image_lib');
				
				$path = FCPATH.'data/stars/';
				$org = $path.$slug.'.jpg';
				$temp = $path.$slug.'_temp.jpg';
				$this->data['photo_result'] = FALSE;
				
				if(copy($vars['i'], $temp)){
				
					$config['resize'] = array(
						'image_library' => 'gd2',
						'source_image' => $temp,
						'new_image' => $org,
						'quality' => '80%',
						'master_dim' => 'width',
						'width' => 300,
						'height' => 400
					);
					
					$this->image_lib->initialize($config['resize']);
				
					if (!$this->image_lib->resize()){
						
						$this->data['cover_result'] = $vars['i'].' -> '.$this->image_lib->display_errors();

					}else{
						
						$this->_actor_photo_thumbs($slug, 250, 362);
						$this->_actor_photo_thumbs($slug, 90, 123);
						unlink($path.$slug.'_temp.jpg');
						
					}
				
				}
					
			}	
			
		}
		
		public function get_cover_image($slug = NULL){
			
			if($slug){
				
				$this->load->library('image_lib');
				
				$crp = $this->input->get('crp', TRUE);
				$image = $this->input->get('img', TRUE);
				$path = FCPATH.'data/covers/';
				$temp = $path.$slug.'_temp.jpg';
				$this->data['cover_result'] = FALSE;
				
				if(copy($image, $temp)){
				
					$config['resize'] = array(
						'image_library' => 'gd2',
						'source_image' => $temp,
						'new_image' => $path.$slug.'.jpg',
						'quality' => '80%',
						'master_dim' => 'width',
						'width' => 1600,
						'height' => 900
					);
					
					$config['crop'] = array(
						'image_library' => 'gd2',
						'source_image' => $path.$slug.'.jpg',
						'maintain_ratio' => FALSE,
						'width' => 1600,
						'height' => 900,
						'x_axis' => '0',
						'y_axis' => '0'
					);
				
					$this->image_lib->initialize($config['resize']);
				
					if (!$this->image_lib->resize()){
						
						$this->data['cover_result'] = $image.' -> '.$this->image_lib->display_errors();
					
					}else{
						
						$img = getimagesize($path.$slug.'.jpg');
						
						if($img[1] > 900){
							
							if($crp == 'middle')
								$config['crop']['y_axis'] = round(($img[1] - 900) / 2);
							elseif($crp == 'bottom')
								$config['crop']['y_axis'] = $img[1] - 900;
						
							$this->image_lib->initialize($config['crop']);
							
							if (!$this->image_lib->crop())								
								$this->data['cover_result'] = $image.' -> '.$this->image_lib->display_errors();

						}
						
						$this->load->model('admin/movie_m');
							
						$this->data['cover_result'] = $this->movie_m->set_cover($slug);
						
						unlink($path.$slug.'_temp.jpg');
					
					}
				
				}else{
					
					$this->data['cover_result'] = 'Image not loaded!!!';
					
				}
				
				
				$this->load->view('admin/results/_select_cover_image', $this->data);
				
			}else{
				
				show_404();
				
			}
			
		}
		
		//Thumb generate
		private function _actor_photo_thumbs($slug, $width, $height){

			$path = FCPATH.'data/stars';
			$image = $path.'/'.$slug.'.jpg';

			if(file_exists($image)){
				
				$this->load->library('image_lib');

				$marker = '_'.$width.'X'.$height.'_';
				$img = @imagecreatefromjpeg($image);

				if($img){
					
					$thumb = $path.'/thumbs/'.$slug.'_'.$width.'X'.$height.'_.jpg';
					
					unlink($thumb);
					
					$config['thumb_marker'] = $marker;
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image;
					$config['new_image'] = $path.'/thumbs';
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = $width;
					$config['height'] = $height;

					$this->image_lib->initialize($config);

					if (!$this->image_lib->resize()){
						
						echo $this->image_lib->display_errors();
						
					}else{
						
						$this->load->model('admin/actors_m');
						
						$this->actors_m->set_photo($slug);
						
					}
		
				}

				return TRUE;
				
			}else{
				
				return FALSE;
				
			}
		
		}
		
		//public function get_file_names(){
		//	
		//	$this->load->helper('directory');
		//	
		//	$files = directory_map(FCPATH.'data/covers/', 0);
		//	
		//	foreach($files as $file)
		//		echo "'".str_replace('.jpg', '', $file)."', ";
		//	
		//}

	}
	
?>