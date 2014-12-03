<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_slug';
	protected $_order_by = 'mvs_id';
	public $per_page = 100;
	
	function __construct ()
	{
		parent::__construct();
	
	}
	
	// Movie list JSON
	public function movies_json($offset = 0){
		
		$filters = array(
				'select' => 'mvs_title, mvs_year, mvs_runtime, mvs_slug, mvs_poster, gnr_id, cntry_id, mvs_imdb_id, mvs_rating',
				'order_by' => 'mvs_year DESC, mvs_rating DESC'
		);
		
		$movies = $this->get_data(NULL, $offset, FALSE, $filters);
		
		if (count($movies['data']))
			return $movies;
		else
			return FALSE;
	
	}
	
	// Movie detail
	public function movie($id){
		
		$id = $this->cleaner($id);
		$movie = $this->get_data($id, 0, FALSE, NULL);
	
		if (count($movie['data']) == 1)
			return $movie;
		else
			return FALSE;
	
	}
	
	// Get all genres
	public function _genres($ids = NULL){
	
		$this->_table_name = 'mvs_genres';
		$this->_primary_key = 'gnr_id';
		$this->_order_by = 'gnr_id';
		
		if($ids == NULL){
			$genres = $this->get_data(NULL, 0);
		}else{
			$filters = array('where' => $ids);
			$genres = $this->get_data(NULL, 0, FALSE, $filters);
		}
	
		if (count($genres['data']))
			return $genres;
		else
			return FALSE;
	
	}
	
	// Get all countries
	public function _countries($ids = NULL){
	
		$this->_table_name = 'mvs_country';
		$this->_primary_key = 'cntry_id';
		$this->_order_by = 'cntry_id';
		$this->per_page = 0;
		
		if($ids == NULL){
			$countries = $this->get_data(NULL, 0);
		}else{
			$filters = array('where' => $ids);
			$countries = $this->get_data(NULL, 0, FALSE, $filters);
		}

		if (count($countries['data']))
			return $countries;
		else
			return FALSE;
	
	}
	
	public function getCastList($id){
	
		$filters = array(
				'select' => 'mvs_cast.mvs_id, mvs_cast.str_id, mvs_cast.char_name, mvs_stars.str_name, mvs_stars.str_slug, mvs_stars.str_photo',
				'from' => 'mvs_cast',
				'join' => array('mvs_stars', 'mvs_cast.str_id = mvs_stars.str_id', 'inner'),
				'where' => array('mvs_id', $id)
		);

		$casts = $this->get_data(NULL, 0, FALSE, $filters, TRUE);
	
		if (count($casts['data']))
			return $casts;
		else
			return FALSE;
	
	}
	
	
}