<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Ajx extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
		}
		
		public function index(){

			
		}
		
		public function lister($p = 1){
			
			if($this->input->is_ajax_request()){
				
				$vars = $this->get_vars;
				$type = $vars['type'];
				$cst_str = '';
				$model = '';
				
				unset($vars['type']);
				
				switch($type){
					
					case 'ml':
							$m_set = array('fn' => $type);
							$model = 'movie_m';
							break;
						
					case 'ucl':
							$model = 'user_custom_list_m';
							$this->load->model($model);
							$cst_str =  array('usr_id' => $this->user['usr_id'], 'list_id' => $vars['list']);
							unset($vars['list']);
							break;

				}
				
				$p = $this->{$model}->cleaner($p);
				$curPage = ($p != '') ? $p : 1;
				$offset = ($curPage-1) * $this->{$model}->per_page;
				$db_data = $this->{$model}->movies_json($offset, $vars, $this->filter_def, $cst_str);
				$movies = $db_data['data'];
				$db_data = $this->movie_m->countries();
				$countries = $db_data;
				$db_data = $this->movie_m->genres();
				$genres = $db_data;
				$json = (object) array();
		
				if($movies){
					
					// Getting User's Seen Movies
					if($this->logged_in)
						$usr_seen = $this->_get_user_seen();
					
					foreach($movies as $movie){
							
						$g = explode('||', trim($movie->gnr_id, '|'));
						$c = explode('||', trim($movie->cntry_id, '|'));
						$temp = array();
					
						for($i=0; $i<count($g); $i++){
							$key = getItemFromObj($genres, $g[$i], 'gnr_id', 'gnr_title');
							array_push($temp, trim($key, ' '));
						}
							
						$movie->mvs_genre = $temp;
						$temp = array();
							
						for($i=0; $i<count($c); $i++){
							$key = getItemFromObj($countries, $c[$i], 'cntry_id', 'cntry_title');
							array_push($temp, trim($key, ' '));
						}
							
						$movie->mvs_country = $temp;				
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
			}else{
				$this->data['json'] = FALSE;	
			}
			
			$this->load->view('json/movies_json', $this->data);
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