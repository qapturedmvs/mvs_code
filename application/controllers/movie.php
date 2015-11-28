<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
			
		}

		public function _remap($method,$args){
		
			if (method_exists($this, $method))
				$this->$method($args);
			else
				$this->index($method,$args);
			
		}
	
		public function index($slug = NULL){

			if($slug){
				
				$data = array('slug' => $slug, ($this->logged_in) ? $this->user['usr_id'] : 0);
				$movie = $this->movie_m->movie($data);
		
				if($movie){
					
					$this->data['controls'] = array('page' => 'movie-detail');
					$this->data['casts'] = array();
						
					foreach($movie as $key => $val){
						
						if($key < 4 && $val['type_id'] == 1)
							$this->data['casts']['stars'][] = array('str_name' => $val['str_name'], 'str_slug' => $val['str_slug'], 'type_id' => 1);
						
						if($val['type_id'] == 2)
							$this->data['casts']['director'][] = array('str_name' => $val['str_name'], 'str_slug' => $val['str_slug'], 'type_id' => 2);
					
					}
					
					if($movie[0]['cntry_id'] != ''){
						
						$movie[0]['cntry_id'] = explode('|', trim($movie[0]['cntry_id'], '|'));
						$temp = $this->cache_table_data('countries', 'movie_m', array('id' => 'cntry_id', 'title' => 'cntry_title'));

						foreach($movie[0]['cntry_id'] as $key => $val)
							$movie[0]['countries'][$key] = $temp[$val];
							
					}
					
					if($movie[0]['gnr_id'] != ''){
						
						$movie[0]['gnr_id'] = explode('|', trim($movie[0]['gnr_id'], '|'));
						$temp = $this->cache_table_data('genres', 'movie_m', array('id' => 'gnr_id', 'title' => 'gnr_title'));
						
						foreach($movie[0]['gnr_id'] as $key => $val)
							$movie[0]['genres'][$key] = $temp[$val];
							
					}

					if($movie[0]['aud_id'] != 0){
						
						$temp = $this->cache_table_data('audience', 'movie_m', array('id' => 'aud_id', 'title' => 'aud_title'));
						$movie[0]['audience'] = $temp[$movie[0]['aud_id']];

					}
					
					$this->data['movie'] = $movie[0];
					
					unset($temp);
					
					// Setting meta_tags object
					$this->data['meta_tags'] = (object) array(
						'title' => $movie[0]['mvs_title'].' ('.$movie[0]['mvs_year'].')',
						'description' => $movie[0]['mvs_plot'],
						'type' => 'movie',
						'image' => $movie[0]['mvs_poster']
					);
					
					if(isset($this->user['usr_id']))
						$this->data['cls'] = $this->_get_customlists($movie[0]['mvs_id']);
					
					// Load view
					$this->data['subview'] = 'movie/detail';
					$this->load->view('_main_body_layout', $this->data);
					
				}else{
					show_404();
				}
			
			}else{
				show_404();
			}
			
		}
		
		private function _get_customlists($mvs_id){
			
			$this->load->model('action_m');
			
			$cls = $this->action_m->get_user_md_customlists(array('usr_id' => $this->user['usr_id'], 'mvs_id' => $mvs_id));

			return $cls;
	
		}
	}

?>