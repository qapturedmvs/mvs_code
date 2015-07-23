<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
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

					$this->data['movie'] = $movie[0];
					$this->data['controls'] = array('page' => 'movie-detail');
					
					// Eğer filmin cast, genre, country bilgilerinden olmayan var ise view'daki loop hata vermesin
					$this->data['casts'] = $movie;
					$this->data['genres'] = array();
					$this->data['countries'] = array();
						
					// Genres & Countries	
					foreach($this->filter_def['like'] as $key => $val){
						
						if($movie[0][$val[0]] != ''){
							$this->data[$val[1]]['data'] = explode('|', trim($movie[0][$val[0]], '|'));
							$this->data[$val[1]]['table'] = $this->cache_table_data($val[1], 'movie_m', array('id' => $val[0], 'title' => $val[2]));
						}
							
					}
					
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