<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actor_M extends MVS_Model
{
	
	function __construct ()
	{
		parent::__construct();
	
	}
	
	// Actor detail
	public function get_actor_movies($data){
		
		$data['slug'] = $this->cleaner($data['slug']);
		$movies = $this->db->call_procedure('sp_get_actor_detail', $data);

		if($movies)
			return $movies;
		else
			return FALSE;
	
	}
    
}