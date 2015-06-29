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
		
		if(isset($vars['mfn']) && $cst_str['usr_id'] !== NULL){
			
			$filters['select'] = 'm.mvs_id, m.mvs_title, m.mvs_year, m.mvs_runtime, m.mvs_slug, m.mvs_poster, m.gnr_id, m.cntry_id, m.mvs_imdb_id, m.mvs_rating';
			
			switch($vars['mfn']){
				
				case 1:
					$filters['join'] = array(
						array('mvs_seen s', 's.usr_id = f.flwd_usr_id', 'inner'),
						array('mvs_movies m', 'm.mvs_id = s.mvs_id', 'inner')
					);
					$filters['group_by'] = 'm.mvs_id';
					$vars['mfn'] = TRUE;
				break;
			
				case 2:
					$filters['join'] = array(
						array('mvs_watchlist w', 'w.usr_id = f.flwd_usr_id', 'inner'),
						array('mvs_movies m', 'm.mvs_id = w.mvs_id', 'inner')
					);
					$filters['group_by'] = 'm.mvs_id';
					$vars['mfn'] = TRUE;
				break;
			
				case 3:
					$filters['join'] = array(
						array('mvs_feeds feed', 'feed.usr_id = f.flwd_usr_id', 'inner'),
						array('mvs_movies m', 'm.mvs_id = feed.mvs_id', 'inner')
					);
					$filters['group_by'] = 'm.mvs_id';
					$vars['mfn'] = TRUE;
				break;
				
			}
			
			if($vars['mfn'] === TRUE){
				$filters['from'] = 'mvs_follows f';
				$filters['where'] = 'f.flwr_usr_id = '.$cst_str['usr_id'];
			}

		}
		
		unset($vars['mfn']);

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
	
	// MOVIE DETAIL
	public function movie($data){
		
		$data['slug'] = $this->cleaner($data['slug']);
		$movie = $this->db->call_procedure('sp_get_movie_detail', $data);

		if($movie)
			return $movie[0];
		else
			return FALSE;
	
	}
	
	// GET ALL GENRES
	public function genres(){

		$this->per_page = 0;
		$filters = array(
			'select' => '*',
			'from' => 'mvs_genres',
			'order_by' => 'gnr_title ASC'
		);

		$genres = $this->get_data(NULL, 0, FALSE, $filters);
	
		if(isset($genres['data']))
			return $genres['data'];
		else
			return FALSE;
	
	}
	
	// GET ALL COUNTRIES
	public function countries(){

		$this->per_page = 0;
		$filters = array(
			'select' => '*',
			'from' => 'mvs_country',
			'order_by' => 'cntry_title ASC'
		);	

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