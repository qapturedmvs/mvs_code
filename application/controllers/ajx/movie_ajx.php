<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
		}
		
		public function index(){ show_404(); }
		
		public function lister($p = 1){
				
				$vars = $this->get_vars;
				$data = array('list_type' => $vars['type'], 'mfn' => (isset($vars['mfn'])) ? $vars['mfn'] : 0, 'mfu' => (isset($vars['mfu'])) ? 1 : 0, 'usr' => (isset($vars['usr'])) ? $vars['usr'] : '', 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'list_id' => (isset($vars['list'])) ? $vars['list'] : 0, 'where' => movies_where(qs_filter($vars, $this->filter_def), $this->filter_def), 'offset' => $p, 'perpage' => 120);
				$movies = $this->movie_m->movies_json($data);
				$tables['genres'] = $this->cache_table_data('genres', 'movie_m', array('id' => 'gnr_id', 'title' => 'gnr_title'));
				$json = (object) array();
				
				if($movies){
					
					foreach($movies as $key => $movie){
						
						$movies[$key]['mvs_genre'] = '';
						
						if($movie['gnr_id'] !== ''){
							
							$genres = explode('|', trim($movie['gnr_id'], '|'));
							
							foreach($genres as $genre)
								$movies[$key]['mvs_genre'] .= ($movies[$key]['mvs_genre'] == '') ? $tables['genres'][$genre] : ', '.$tables['genres'][$genre];
						
						}
										
						$movies[$key]['mvs_poster'] = getMoviePoster($movie['mvs_poster'], $movie['mvs_slug'], 'original');
						
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

	}

?>