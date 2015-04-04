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
		
		unset($data['p']);

		$feeds = $this->db->call_procedure('sp_get_wall', $data);

		if($feeds)
			return $feeds;
		else
			return FALSE;
	
	}
  
}

?>