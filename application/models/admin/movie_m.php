<?php

class Movie_M extends MVS_Model
{

	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_id';
	//protected $_primary_filter = 'intval';
	protected $_order_by = 'mvs_id';
	protected $_per_page = 100;

	function __construct ()
	{
		parent::__construct();
	}
	
	public function movies($offset){
		
		$movies = $this->get(NULL,FALSE,$offset);
		
		if (count($movies)){
			
			return $movies;
			
		}else{
			
			return 0;
			
		}
		
	}

}