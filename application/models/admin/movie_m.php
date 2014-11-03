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
		
		if(isset($_GET['orderBy']))
			$this->_order_by = 'mvs_'.$_GET['orderBy'];
		
		if(isset($_GET['orderRule']))
			$this->_order_rule = $_GET['orderRule'];
	}
	
	public function movies($offset = 0){
		
		$movies = $this->get(NULL,FALSE,$offset);
		
		if (count($movies))
			return $movies;
		else
			return "No data found...";
<<<<<<< HEAD

=======
>>>>>>> parent of 5685b4c... Movie detay
		
	}

}