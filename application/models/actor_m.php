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
	
	// Actor graph
	public function get_actor_graph($data){
		
		$data['slug'] = $this->cleaner($data['slug']);
		$gps = $this->db->call_procedure('sp_get_actor_graph', $data);

		if($gps)
			return $gps;
		else
			return FALSE;
	
	}
	
	// Actor graph
	public function test_func($data){
		
		//$out = array('@result' => NULL);
		//$gps = $this->db->call_procedure('sp_test_multi', $data, $out);
		//$result = $out['@result'];
		
		$gps = $this->db->call_procedure('sp_test_multi', $data);

		//var_dump($gps);
		//var_dump($result);
	
	}
    
}