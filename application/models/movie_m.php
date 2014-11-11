<?php

class Movie_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_id';
	protected $_order_by = 'mvs_id';
	public $per_page = 100;
	
	function __construct ()
	{
		parent::__construct();
	
	}
	
	// Movie list JSON
	public function movies_json($offset = 0){
	
		$movies = $this->get(NULL,FALSE,$offset,$select = 'mvs_title, mvs_year, mvs_runtime, gnr_id, cntry_id');		
		
		if (count($movies))
			return $movies;
		else
			return FALSE;
	
	}
	
	// Movie detail
	public function movie($id){
		
		$id = $this->cleaner($id);
		$this->_primary_key = 'mvs_slug';
		$this->_primary_filter = NULL;
		$movie = $this->get($id);
	
		if (count($movie) == 1)
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
			$genres = $this->get(NULL,FALSE,0);
		}else{
			$genres = $this->get_with('*', $ids);
		}
	
		if (count($genres))
			return $genres;
		else
			return FALSE;
	
	}
	
	// Get all countries
	public function _countries($ids = NULL){
	
		$this->_table_name = 'mvs_country';
		$this->_primary_key = 'cntry_id';
		$this->_order_by = 'cntry_id';
		$this->per_page = 200;
		
		if($ids == NULL){
			$countries = $this->get(NULL,FALSE,0);
		}else{
			$countries = $this->get_with('*', $ids);
		}

		if (count($countries))
			return $countries;
		else
			return FALSE;
	
	}
	
	public function getCastList($id){
	
		$this->db->select('mvs_cast.mvs_id, mvs_cast.str_id, mvs_cast.char_name, mvs_stars.str_name, mvs_stars.str_slug, mvs_stars.str_photo');
		$this->db->from('mvs_cast');
		$this->db->join('mvs_stars', 'mvs_cast.str_id = mvs_stars.str_id', 'inner');
		$this->db->where('mvs_id', $id);
		$casts = $this->db->get()->result();
	
		if (count($casts))
			return $casts;
		else
			return FALSE;
	
	}
	
	
}