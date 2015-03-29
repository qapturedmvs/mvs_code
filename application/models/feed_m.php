<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_M extends MVS_Model
{

	public $per_page = 0;
  
	function __construct (){
		parent::__construct();
	}
  
  //WALL JSON
	public function wall_json($data){

		$feeds = $this->db->call_procedure('sp_get_wall', $data);

		if($feeds)
			return $feeds;
		else
			return FALSE;
	
	}
  
}

?>