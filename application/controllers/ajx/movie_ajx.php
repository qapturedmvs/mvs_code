<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Ajx extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
		}
		
		public function index(){

			
		}
		
		public function lister($p = NULL){
			
			$vars = ($this->get_vars) ? $this->get_vars : NULL;
			
			if($this->input->is_ajax_request()){
				$p = $this->movie_m->cleaner($p);
				$curPage = ($p != '') ? $p : 1;
				$offset = ($curPage-1) * $this->movie_m->per_page;
				$db_data = $this->movie_m->movies_json($offset, $vars, $this->filter_def);
				$movies = $db_data['data'];
				$db_data = $this->movie_m->countries();
				$countries = $db_data;
				$db_data = $this->movie_m->genres();
				$genres = $db_data;
				$json = (object) array();
		
				if($movies){
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
						$movie->mvs_poster = (file_exists(FCPATH."data\movies\\thumbs\\".$movie->mvs_imdb_id."_175x240_.jpg")) ? "data/movies/thumbs/".$movie->mvs_imdb_id."_175x240_.jpg" : NULL;
						
					}
					
					$json->result = 'OK';
					$json->data = $movies;
				}else{
					$json->result = 'FALSE';
					$json->data = '';
				}
				
				$data['json'] = json_encode($json);
			}else{
				$data['json'] = FALSE;	
			}
			
			$this->load->view('json/movies_json', $data);
		}
			
	}

?>