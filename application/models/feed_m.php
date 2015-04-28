<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_M extends MVS_Model
{

	public $per_page = 50;
  
	function __construct (){
		parent::__construct();
	}
  
  //WALL JSON
	public function wall_json($data){

		$data['p'] = $this->cleaner($data['p']);
    $data['offset'] = ($data['p']-1) * $this->per_page;
		$data['perpage'] = $this->per_page;
		$data['time'] = $this->session->flashdata('page_load_time');
		
		unset($data['p']);

		$feeds = $this->db->call_procedure('sp_get_wall', $data);

		if($feeds)
			return $feeds;
		else
			return FALSE;
	
	}
	
	//FEEDS JSON
	public function feeds_json($data){
		
		$data['p'] = $this->cleaner($data['p']);
    $data['offset'] = ($data['p']-1) * $this->per_page;
		$data['perpage'] = $this->per_page;
		$data['time'] = $this->session->flashdata('page_load_time');
		
		unset($data['p']);

		$feeds = $this->db->call_procedure('sp_get_feeds', $data);

		if($feeds)
			return $feeds;
		else
			return FALSE;
	
	}
	
	//GET MORE REVIEW REPLIES
	public function get_more_replies($data){

		$feeds = $this->db->call_procedure('sp_get_more_replies', $data);

		if($feeds)
			return $feeds;
		else
			return FALSE;
	
	}
	
	public function rate_review($data){
			
			$data['act_id'] = $this->cleaner($data['act_id']);
			$out = array('@result' => NULL);
			$this->db->call_procedure('sp_rate_review', $data, $out);
			$result = $out['@result'];
		
		return $result;
	
	}
  
}

?>