<?php

class Movie_M extends MVS_Model
{
	
		
	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_id';
	protected $_order_by = 'mvs_id';
	protected $_order_rule = 'ASC';
	public $per_page = 100;

	function __construct ()
	{
		parent::__construct();
		
		// Getting sort arguments
		if(isset($_GET['orderBy']))
			$this->_order_by = 'mvs_'.$this->cleaner($_GET['orderBy']);
		
		if(isset($_GET['orderRule']))
			$this->_order_rule = $this->cleaner($_GET['orderRule']);
	}
	
	public function movies($offset = 0){
		
		$movies = $this->get(NULL,FALSE,$offset);
		
		if (count($movies))
			return $movies;
		else
			return FALSE;
		
	}
	
	public function movie($id){
	
		$movie = $this->get($id);
	
		if (count($movie) == 1)
			return $movie;
		else
			show_404();
	
	}
	
	// Get all genres
	public function genres(){
		
		$this->_table_name = 'mvs_genres';
		$this->_primary_key = 'gnr_id';
		$this->_order_by = 'gnr_id';
		$genres = $this->get(NULL,FALSE,0);
	
		if (count($genres))
			return $genres;
		else
			return FALSE;
	
	}
	
	// Get all countries
	public function countries(){
	
		$this->_table_name = 'mvs_country';
		$this->_primary_key = 'cntry_id';
		$this->_order_by = 'cntry_id';
		$this->per_page = 200;
		
		$countries = $this->get(NULL,FALSE,0);
	
		if (count($countries))
			return $countries;
		else
			return FALSE;
	
	}
	
	public function getCastList($id){
// 		$query = "SELECT mvs_cast.mvs_id, mvs_cast.str_id, mvs_cast.char_name, mvs_stars.str_name FROM mvs_cast 
// 					INNER JOIN mvs_stars ON mvs_cast.str_id = mvs_stars.str_id
// 					WHERE mvs_id = 510;";
		
// 		$casts = $this->db->query($query)->result();

		$this->db->select('mvs_cast.mvs_id, mvs_cast.str_id, mvs_cast.char_name, mvs_stars.str_name');
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