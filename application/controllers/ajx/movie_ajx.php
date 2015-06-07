<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			
			//$this->output->enable_profiler(TRUE);
			$this->load->model('movie_m');
		}
		
		public function index(){ show_404(); }
		
		public function lister($p = 1){
				
				$vars = $this->get_vars;
				$cst_str = '';
				$model = '';

				switch($vars['type']){
					
					case 'ml':
							$cst_str =  array('usr_id' => $this->user['usr_id']);
							$model = 'movie_m';
							break;
						
					case 'ucl':
							$model = 'user_custom_list_m';
							$this->load->model($model);
							$cst_str =  array('usr_id' => $this->user['usr_id'], 'list_id' => $vars['list']);
							unset($vars['list']);
							break;
					
					case 'us':
							$model = 'seen_m';
							$this->load->model($model);
							$cst_str =  array('usr_id' => $vars['usr']);
							unset($vars['usr']);
							break;
						
					case 'uwl':
							$model = 'watchlist_m';
							$this->load->model($model);
							$cst_str =  array('usr_id' => $vars['usr']);
							unset($vars['usr']);
							break;
						
					case 'uapp':
							$model = 'applaud_m';
							$this->load->model($model);
							$cst_str =  array('usr_id' => $vars['usr']);
							unset($vars['usr']);
							break;

				}
				
				unset($vars['type']);
				
				$p = $this->{$model}->cleaner($p);
				$curPage = ($p != '') ? $p : 1;
				$offset = ($curPage-1) * $this->{$model}->per_page;
				$db_data = $this->{$model}->movies_json($offset, $vars, $this->filter_def, $cst_str);
				$movies = $db_data['data'];
				$tables['genres'] = $this->cache_table_data('genres', 'movie_m', array('id' => 'gnr_id', 'title' => 'gnr_title'));
				$tables['countries'] = $this->cache_table_data('countries', 'movie_m', array('id' => 'cntry_id', 'title' => 'cntry_title'));
				$json = (object) array();
		
				if($movies){
					
					// Getting User's Seen Movies
					if($this->logged_in)
						$usr_seen = $this->_get_user_seen();
					
					foreach($movies as $movie){
						
						$movie->mvs_genre = array();
						$movie->mvs_country = array();
						
						if($movie->gnr_id !== ''){
							
							$genres = explode('|', trim($movie->gnr_id, '|'));
							
							foreach($genres as $genre)
								$movie->mvs_genre[] = $tables['genres'][$genre];
						
						}
						
						if($movie->cntry_id !== ''){
							
							$countries = explode('|', trim($movie->cntry_id, '|'));
							
							foreach($countries as $country)
								$movie->mvs_country[] = $tables['countries'][$country];
							
						}
										
						$movie->mvs_poster = (file_exists(FCPATH."data\movies\\thumbs\\".$movie->mvs_slug."_175x240_.jpg")) ? "data/movies/thumbs/".$movie->mvs_slug."_175x240_.jpg" : NULL;
						
						// Users Seen Check
						if(isset($usr_seen['list'][$movie->mvs_id]))
							$movie->usr_seen = 1;
						else
							$movie->usr_seen = 0;
						
					}
					
					$json->result = 'OK';
					$json->data = $movies;
				}else{
					$json->result = 'FALSE';
					$json->data = '';
				}
				
				$this->data['json'] = json_encode($json);
				
				$this->load->view('json/main_json_view', $this->data);
			
		}
		
		private function _get_user_seen(){
			
			$this->load->model('action_m');
			
			$seen = $this->action_m->get_user_seen($this->user['usr_id']);
			$usr_seen = array('count' => $seen['total_count'], 'list' => array());
			
			if($seen){
				
				foreach($seen['data'] as $movie){
					
					$usr_seen['list'][$movie->mvs_id] = $movie->seen_id;
					
				}
				
			}
			
			return $usr_seen;
			
		}

	}

?>