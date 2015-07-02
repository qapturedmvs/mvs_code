<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_feeds';
	protected $_primary_key = 'act_id';
	protected $_order_by = 'act_time';
	public $per_page = 20;
  
	function __construct (){
		parent::__construct();
	}
	
	// Movie Detail Comments
	public function movie_comments_json($data){

		$data['p'] = $this->cleaner($data['p']);
    $data['offset'] = ($data['p']-1) * $this->per_page;
		$data['perpage'] = $this->per_page;
		
		unset($data['p']);

		$feeds = $this->db->call_procedure('sp_get_movie_reviews', $data);

		if($feeds)
			return $feeds;
		else
			return FALSE;
	
	}
	
	// Custom List Comments
	public function customlist_comments_json($data){

		$data['p'] = $this->cleaner($data['p']);
    $data['offset'] = ($data['p']-1) * $this->per_page;
		$data['perpage'] = $this->per_page;
		
		unset($data['p']);

		$feeds = $this->db->call_procedure('sp_get_customlist_reviews', $data);

		if($feeds)
			return $feeds;
		else
			return FALSE;
	
	}
	
	public function add_comment($data){
		var_dump($data);
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_add_review', $data, $out);
		
		$result = $out['@result'];
		var_dump($result);
		return $result;
	
	}
	
	//public function reply_comment($data){
	//
	//	$out = array('@result' => NULL);
	//	$this->db->call_procedure('sp_reply_review', $data, $out);
	//	$result = $out['@result'];
	//
	//	return $result;
	//
	//}
	
	public function edit_comment($data){
	
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_edit_feed', $data, $out);
		$result = $out['@result'];

		return $result;
	
	}
	
	public function delete_comment($data){
	
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_delete_feed', $data, $out);
		$result = $out['@result'];

		return $result;
	
	}
  
  
}

?>