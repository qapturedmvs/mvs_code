<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie_M extends MVS_Model
{
	
		
	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_id';
	protected $_order_by = 'mvs_id';
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
	
	public function movies($p){
		
		$offset = ($this->cleaner($p) - 1) * $this->per_page;
		$filters = array('order_by' => array($this->_order_by, 'ASC'));
		$movies = $this->get_data(NULL, $offset, FALSE, $filters);
		$movies['offset'] = $offset;
		$movies['per_page'] = $this->per_page;
		
		if (count($movies['data']))
			return $movies;
		else
			return FALSE;
		
	}
	
	public function movie($id){
	
		$movie = $this->get_data($id);
	
		if (count($movie['data']) == 1)
			return $movie;
		else
			return FALSE;
	
	}
	
	// Get all genres
	public function _genres(){
		
		$this->_table_name = 'mvs_genres';
		$this->_primary_key = 'gnr_id';
		$this->_order_by = 'gnr_id';

		$genres = $this->get_data();
	
		if (count($genres['data']))
			return $genres;
		else
			return FALSE;
	
	}
	
	// Get all langs
	public function _langs(){
		
		$this->_table_name = 'mvs_lang';
		$this->_primary_key = 'lang_id';
		$this->_order_by = 'lang_id';

		$langs = $this->get_data();

		if (count($langs['data']))
			return $langs;
		else
			return FALSE;
	
	}
	
	// Get all countries
	public function _countries(){
	
		$this->_table_name = 'mvs_country';
		$this->_primary_key = 'cntry_id';
		$this->_order_by = 'cntry_id';
		$this->per_page = 200;
		
		$countries = $this->get_data();
	
		if (count($countries['data']))
			return $countries;
		else
			return FALSE;
	
	}
	
	public function getCastList($id){

		$filters = array(
				'select' => 'mvs_cast.mvs_id, mvs_cast.str_id, mvs_cast.char_name, mvs_stars.str_name', 
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
	
	public function set_cover($slug){
		
		$this->db->update('mvs_movies', array('mvs_cover' => 1), array('mvs_slug' => $slug));
		
		return TRUE;
		
	}

}