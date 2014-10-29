<?php

class Movie_M extends MVS_Model
{
	
		
	protected $_table_name = 'mvs_movies';
	protected $_primary_key = 'mvs_id';
	protected $_order_by = 'mvs_id';
	protected $_per_page = 100;

	function __construct ()
	{
		parent::__construct();
		
		if(isset($_GET['sort']))
			$this->_order_by = 'mvs_'.$_GET['sort'];
	}
	
	public function movies($offset = 0){
		
		$movies = $this->get(NULL,FALSE,$offset);
		
		if (count($movies)){
			
			return $movies;
			
		}else{
			
			// Bu kısım düzenlenecek
			return 0;
			
		}
		
	}

}