<?php

class Movie_M extends MVS_Model
{
	
		
	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_id';
	protected $_order_by = 'mvs_id';
	protected $_order_rule = 'ASC';
	protected $_per_page = 100;

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
			return "No data found...";

		
	}

}