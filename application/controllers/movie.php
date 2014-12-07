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
	
		public function index($id = NULL){

			if($this->uri->segment(2) != 'index'){	// Url'den index ile çağırılırsa 404 dönmeli
				
				$movie = $this->movie_m->movie($id);
		
				if($movie['data']){
					$movie['data']->mvs_cover = $this->data['site_url']."data/movies/thumbs/".$movie['data']->mvs_imdb_id."_".$this->config->item('mvs_img_suffix_m')."_.jpg";
					$this->data['movie'] = $movie['data'];
					
					// Eğer filmin cast, genre, country bilgilerinden olmayan var ise view'daki loop hata vermesin
					$this->data['casts'] = array();
					$this->data['genres'] = array();
					$this->data['countries'] = array();
					
					$casts = $this->movie_m->getCastList($movie['data']->mvs_id);
					
					if($casts) $this->data['casts'] = $casts['data'];
					
					if($movie['data']->cntry_id != ''){
								$cntId = str_replace('||', ',', trim($movie['data']->cntry_id, '|'));
								$countries = $this->movie_m->_countries('cntry_id IN('.$cntId.')');
								$this->data['countries'] = $countries['data'];
					}
					
					if($movie['data']->gnr_id != ''){
								$gnrId = str_replace('||', ',', trim($movie['data']->gnr_id, '|'));
								$genres = $this->movie_m->_genres('gnr_id IN('.$gnrId.')');
								$this->data['genres'] = $genres['data'];
					}
					
					// Setting meta_tags object
					$this->data['meta_tags'] = (object) array(
																'title' => $movie['data']->mvs_title.' ('.$movie['data']->mvs_year.')',
																'description' => $movie['data']->mvs_plot,
																'type' => 'movie',
																'image' => $movie['data']->mvs_poster
												);
					
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
	}

?>