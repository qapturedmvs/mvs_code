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

			if($id){	// Url'den index ile çağırılırsa 404 dönmeli

				$movie = $this->movie_m->movie($id);
		
				if($movie){

					//$movie['data']->mvs_cover = $this->data['site_url'].'data/movies/thumbs/'.$movie['data']->mvs_slug.'_'.$this->config->item('mvs_img_suffix_m').'_.jpg';
					$this->data['movie'] = $movie['data'];
					$this->data['controls'] = array('page' => 'movie-detail');
					
					// Eğer filmin cast, genre, country bilgilerinden olmayan var ise view'daki loop hata vermesin
					$this->data['casts'] = array();
					$this->data['genres'] = array();
					$this->data['countries'] = array();
					
					$casts = $this->movie_m->getCastList(str_replace('|', ',', trim($movie['data']->cst_id, '|')));

					if($casts)
						$this->data['casts'] = $casts['data'];
					
					if($movie['data']->cntry_id != ''){
						$cntId = str_replace('|', ',', trim($movie['data']->cntry_id, '|'));
						$countries = $this->movie_m->countries('cntry_id IN('.$cntId.')');
						$this->data['countries'] = $countries;
					}
					
					if($movie['data']->gnr_id != ''){
						$gnrId = str_replace('|', ',', trim($movie['data']->gnr_id, '|'));
						$genres = $this->movie_m->genres('gnr_id IN('.$gnrId.')');
						$this->data['genres'] = $genres;
					}
					
					// Setting meta_tags object
					$this->data['meta_tags'] = (object) array(
						'title' => $movie['data']->mvs_title.' ('.$movie['data']->mvs_year.')',
						'description' => $movie['data']->mvs_plot,
						'type' => 'movie',
						'image' => $movie['data']->mvs_poster
					);
					
					if(isset($this->user['usr_id']))
						$this->data['actions'] = $this->_set_actions($movie['data']->mvs_id);
					
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
		
		private function _set_actions($mvs_id){
			
			$this->load->model('action_m');
			
			$db_data['lists'] = $this->action_m->get_movie_actions(array('mvs_id' => $mvs_id, 'usr_id' => $this->user['usr_id']));
			
			//// Seen Movie Check
			//$db_data['seen'] = $this->action_m->check_seen(array('mvs_id' => $mvs_id, 'usr_id' => $this->user['usr_id']));
			//
			//// Watchlist Movie Check
			//$db_data['watchlist'] = $this->action_m->check_watchlist(array('mvs_id' => $mvs_id, 'usr_id' => $this->user['usr_id']));
			//
			//// User's Custom Lists
			//$db_data['custom_lists'] = $this->action_m->get_custom_lists(array('mvs_id' => $mvs_id, 'usr_id' => $this->user['usr_id']));
			
			return $db_data;
	
		}
	}

?>