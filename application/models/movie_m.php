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
	public function movies_json($data){
		
		$data['list_type'] = $this->cleaner($data['list_type']);
		$data['mfn'] = ($data['mfn'] !== 0) ? $this->cleaner($data['mfn']) : 0;
		$data['usr'] = ($data['usr'] !== '') ? $this->cleaner($data['usr']) : '';
		$data['list_id'] = ($data['list_id'] !== 0) ? $this->cleaner($data['list_id']) : 0;
		$data['where'] = ($data['where'] !== '') ? $this->cleaner($data['where']) : '';
		$data['offset'] = ($this->cleaner($data['offset']) - 1) * $data['perpage'];
		$movies = $this->db->call_procedure('sp_get_movie_list', $data);

		if($movies)
			return $movies;
		else
			return FALSE;
	
	}
	
	// Movie list Count
	public function movies_count($data){
		
		$data['mfn'] = ($data['mfn'] !== 0) ? $this->cleaner($data['mfn']) : 0;
		$data['where'] = ($data['where'] !== '') ? $this->cleaner($data['where']) : '';
		$count = $this->db->call_procedure('sp_get_movie_list_count', $data);

		if($count)
			return $count[0]['total_count'];
		else
			return FALSE;
	
	}
	
	// MOVIE DETAIL
	public function movie($data){
		
		$data['slug'] = $this->cleaner($data['slug']);
		$movie = $this->db->call_procedure('sp_get_movie_detail', $data);

		if($movie)
			return $movie;
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
	
	// GET ALL AUDIENCE
	public function audience(){

		$this->per_page = 0;
		$filters = array(
			'select' => '*',
			'from' => 'mvs_audience',
			'order_by' => 'aud_title ASC'
		);	

		$audience = $this->get_data(NULL, 0, FALSE, $filters);

		if(isset($audience['data']))
			return $audience['data'];
		else
			return FALSE;
	
	}
	
}