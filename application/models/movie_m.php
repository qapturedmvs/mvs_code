<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_slug';
	public $per_page = 100;
	
	function __construct ()
	{
		parent::__construct();
	}
	
	// Movie list JSON
	public function movies_json($offset = 0, $vars, $defs, $cst_str){


		$filters = array(
			'select' => 'mvs_id, mvs_title, mvs_year, mvs_runtime, mvs_slug, mvs_poster, gnr_id, cntry_id, mvs_imdb_id, mvs_rating',
			'order_by' => 'mvs_year DESC, mvs_rating DESC'
		);

		
		if(count($vars) > 0){
				$vars = qs_filter($vars, $defs);
				$filters['where'] = (isset($filters['where'])) ? $filters['where'].' AND '.movies_where($vars, $defs) : movies_where($vars, $defs);
		}
		
		$movies = $this->get_data(NULL, $offset, FALSE, $filters);
		
		if(isset($movies['data']))
			return $movies;
		else
			return FALSE;
	
	}
	
	// Movie detail
	public function movie($id){
		
		$id = $this->cleaner($id);
		$movie = $this->get_data($id, 0, FALSE, NULL);
	
		if(isset($movie['data']))
			return $movie;
		else
			return FALSE;
	
	}
	
	// Get all genres
	public function genres($ids = NULL){
	
		$this->_table_name = 'mvs_genres';
		$this->_primary_key = 'gnr_id';
		$this->_order_by = 'gnr_id';
		$this->per_page = 0;
		$filters = NULL;
		
		if($ids != NULL)
				$filters['where'] = $ids;
		//		$genres = $this->get_data(NULL, 0, FALSE, $filters);
		//		$genres = $genres['data'];
		//}else{
		//		if(!$genres = $this->cache->get('genres')){
		//				$genres = $this->get_data(NULL, 0, FALSE, $filters);
		//				$this->cache->save('genres', $genres['data'], 600);
		//				$genres = $genres['data'];
		//		}
		//}
		
		$genres = $this->get_data(NULL, 0, FALSE, $filters);
	
		if(isset($genres['data']))
			return $genres['data'];
		else
			return FALSE;
	
	}
	
	// Get all countries
	public function countries($ids = NULL){
	
		$this->_table_name = 'mvs_country';
		$this->_primary_key = 'cntry_id';
		$this->_order_by = 'cntry_id';
		$this->per_page = 0;
		$filters = NULL;	

    if($ids != NULL)
				$filters['where'] = $ids;
//				$countries = $this->get_data(NULL, 0, FALSE, $filters);
//				$countries = $countries['data'];
//    }else{
//				if(!$countries = $this->cache->get('countries')){
//						$countries = $this->get_data(NULL, 0, FALSE, $filters);
//						$this->cache->save('countries', $countries['data'], 600);
//						$countries = $countries['data'];
//				}
//		}

		$countries = $this->get_data(NULL, 0, FALSE, $filters);

		if(isset($countries['data']))
			return $countries['data'];
		else
			return FALSE;
	
	}
	
	public function getCastList($cst_ids){
		
		$this->per_page = 0;
		
		$filters = array(
				'select' => 'mvs_cast.mvs_id, mvs_cast.str_id, mvs_cast.char_name, mvs_stars.str_name, mvs_stars.str_slug, mvs_stars.str_photo',
				'from' => 'mvs_cast',
				'join' => array('mvs_stars', 'mvs_cast.str_id = mvs_stars.str_id', 'inner'),
				'where' => "cst_id IN($cst_ids)",
				'limit' => 4
		);

		$casts = $this->get_data(NULL, 0, FALSE, $filters);
	
		if(isset($casts['data']))
			return $casts;
		else
			return FALSE;
	
	}
	
	public function _filters($vars, $defs){
				
				$this->per_page = 0;
				$filters = array(
								'select' => 'gnr_id, cntry_id, aud_id, mvs_year, mvs_rating',
								'from' => 'mvs_movies'
				);
				
				if($vars != NULL)
					$filters['where'] = movies_where($vars, $defs);

				$movies = $this->get_data(NULL, 0, FALSE, $filters);
				
				if(isset($movies['data']))
					return $movies;
				else
				  return FALSE;
				
	}
	
}