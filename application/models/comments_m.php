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
	
	// MOVIE DETAIL COMMENTS
	public function movie_comments_json($mvs_id, $usr_id = NULL, $offset = 0){
		
		$filters = array(
			'select' => 'act_id,act_ref_id,act_type_id,act_text,act_time,u.usr_id,usr_nick,usr_name',
			'from' => 'mvs_feeds f',
			'join' => array('mvs_users u', 'f.usr_id = u.usr_id', 'left'),
			'where' => "mvs_id = $mvs_id",
			'order_by' => $this->_order_by.' DESC'
		);
		
		if($usr_id != NULL){		
			
			$filters['where'] .= " AND usr_id = $usr_id";
			$feeds = $this->get_data(NULL, $offset, FALSE, $filters);
		
		}else{
			
			$feeds = $this->get_data(NULL, $offset, FALSE, $filters);
			
		}
		
		if(isset($feeds['data']))
			return $feeds;
		else
			return FALSE;
	
	}
  
  
}

?>