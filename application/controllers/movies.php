<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('movie_m');
		}
		
		public function index(){
			
			//$allFilters = $this->movie_m->_allFilters;
			$db_data['genres'] = $this->movie_m->_genres();
			$db_data['countries'] = $this->movie_m->_countries();
			
			//if($this->get_vars){
			//	$movies = $this->movie_m->_filters($this->get_vars);
			//	$tables['gnr_id'] = $db_data['genres']['data'];
			//	$tables['cntry_id'] = $db_data['countries']['data'];
			//	$fFilters = $this->_filter_filters($movies['data'], $tables);
			//	
			//	foreach($allFilters['like'] as $item){
			//		if(count($fFilters[$item]) == 0){
			//			$fFilters[$item] = $tables[$item];
			//		}
			//	}
			//	
			//}else{
				$fFilters['gnr_id'] = $db_data['genres']['data'];
				$fFilters['cntry_id'] = $db_data['countries']['data'];
			//}

			$this->data['filters'] = $fFilters;
			$this->data['subview'] = 'movie/list';
			$this->load->view('_main_body_layout', $this->data);	
			
		}
		
		public function _filter_filters($data, $tables){
			
			$fArr = movies_where($this->get_vars, $this->movie_m->_allFilters, TRUE);
			$tArr = array();
			
			if(!array_key_exists('gnr_id', $fArr)){
				$tArr['gnr_id'] = FALSE;
				$fArr['gnr_id'] = array();
			}
			
			if(!array_key_exists('cntry_id', $fArr)){
				$tArr['cntry_id'] = FALSE;
				$fArr['cntry_id'] = array();
			}
			
			if(!array_key_exists('aud_id', $fArr)){
				$tArr['aud_id'] = FALSE;
				$fArr['aud_id'] = array();
			}
				
			if(!array_key_exists('mvs_year', $fArr)){
				$tArr['mvs_year'] = FALSE;
				$fArr['mvs_year'] = array();
			}
			
			if(!array_key_exists('mvs_rating', $fArr)){
				$tArr['mvs_rating'] = FALSE;
				$fArr['mvs_rating'] = array();
			}

			foreach($data as $movie){
				
				if(array_key_exists('gnr_id', $tArr) && !$tArr['gnr_id']){
					 $ids = explode('||', trim($movie->gnr_id, '|'));
					 
					 foreach($ids as $id){
						 if(!array_key_exists($id, $fArr['gnr_id'])){
								$key = getItemFromObj($tables['gnr_id'], $id, 'gnr_id', 'gnr_title');
								$fArr['gnr_id'][$id] = $key;
						 }
					 }
				}
				
				if(array_key_exists('cntry_id', $tArr) && !$tArr['cntry_id']){
					 $ids = explode('||', trim($movie->cntry_id, '|'));
					 
					 foreach($ids as $id){
						 if(!array_key_exists($id, $fArr['cntry_id'])){
								$key = getItemFromObj($tables['cntry_id'], $id, 'cntry_id', 'cntry_title');
								$fArr['cntry_id'][$id] = $key;
						 }
					 }
				}
				
				if(array_key_exists('aud_id', $tArr) && !$tArr['aud_id'] && !in_array($movie->aud_id, $fArr['aud_id']))
					array_push($fArr['aud_id'], $movie->aud_id);
				
				if(array_key_exists('mvs_year', $tArr) && !$tArr['mvs_year'] && !in_array($movie->mvs_year, $fArr['mvs_year']))
					array_push($fArr['mvs_year'], $movie->mvs_year);
				
				if(array_key_exists('mvs_rating', $tArr) && !$tArr['mvs_rating'] && !in_array($movie->mvs_rating, $fArr['mvs_rating']))
					array_push($fArr['mvs_rating'], $movie->mvs_rating);
				
			}

			return $fArr;
			
		}
	
	}

?>