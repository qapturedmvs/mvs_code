<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
		}
		
		public function index(){ show_404(); }
		
		public function lister($p = 1){
				
				$vars = $this->get_vars;
				$data = array('list_type' => $vars['type'], 'mfn' => (isset($vars['mfn'])) ? $vars['mfn'] : 0, 'usr' => (isset($vars['usr'])) ? $vars['usr'] : '', 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'list_id' => (isset($vars['list'])) ? $vars['list'] : 0, 'where' => $this->_movies_where($vars, $this->filter_def), 'offset' => $p, 'perpage' => 100);
				$movies = $this->movie_m->movies_json($data);
				$tables['genres'] = $this->cache_table_data('genres', 'movie_m', array('id' => 'gnr_id', 'title' => 'gnr_title'));
				$tables['countries'] = $this->cache_table_data('countries', 'movie_m', array('id' => 'cntry_id', 'title' => 'cntry_title'));
				$json = (object) array();
				
				if($movies){
					
					foreach($movies as $key => $movie){
						
						$movies[$key]['mvs_genre'] = array();
						$movies[$key]['mvs_country'] = array();
						
						if($movie['gnr_id'] !== ''){
							
							$genres = explode('|', trim($movie['gnr_id'], '|'));
							
							foreach($genres as $genre)
								$movies[$key]['mvs_genre'][] = $tables['genres'][$genre];
						
						}
						
						if($movie['cntry_id'] !== ''){
							
							$countries = explode('|', trim($movie['cntry_id'], '|'));
							
							foreach($countries as $country)
								$movies[$key]['mvs_country'][] = $tables['countries'][$country];
							
						}
										
						$movies[$key]['mvs_poster'] = getMoviePoster($movie['mvs_poster'], $movie['mvs_slug'], 'medium');
						
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
		
		private function _movies_where($vars, $defs){
			
			$vars = qs_filter($vars, $defs);
			$where = '';
			
			if($vars){
	
				foreach($vars as $key => $val){
					
					$where_or = '';
					
					if(isset($defs['like'][$key])){
	
						 $sep = ($where == '') ? '' : ' AND ';
			 
						foreach($val as $v){
						 
							$sSep = ($where_or == '') ? '' : ' OR ';
							$where_or .= $sSep.$defs['like'][$key][0]." LIKE '%|".$v."|%'";
									
						}
						 
						if($where_or != '')
							$where .= $sep.'('.$where_or.')';
	
								
					}else if(isset($defs['equal'][$key])){
	
						$sep = ($where == '') ? '' : ' AND ';
						
						foreach($val as $v){
							
							$sSep = ($where_or == '') ? '' : ' OR ';
							$where_or .= $sSep.$defs['equal'][$key][0].' = '.$v;
							
						}
						 
						if($where_or != '')
							$where .= $sep.'('.$where_or.')';
	
					}else if(isset($defs['between'][$key])){
						
						 $sep = ($where == '') ? '' : ' AND ';
						 $where .= $sep.'('.$defs['between'][$key].' BETWEEN '.$val[0].' AND '.$val[1].')';
						 
					}
					 
				}
			
			}
			
			return $where;
			
		}

	}

?>