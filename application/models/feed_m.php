<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_feeds';
	protected $_primary_key = 'act_id';
	protected $_order_by = 'act_time';
	public $per_page = 0;
  
	function __construct (){
		parent::__construct();
	}
  
  //FEEDS JSON
	public function feeds_json($usr_id, $offset = 0){
				
		$filters = array(
				'select' => '*',
        'from' => $this->_table_name,
        'where' => array('usr_id' => $usr_id),
				'order_by' => $this->_order_by.' DESC'
		);
		
		$feeds = $this->get_data(NULL, $offset, FALSE, $filters);
		
		if(isset($feeds['data']))
			return $feeds;
		else
			return FALSE;
	
	}
	
	// MOVIE DETAIL FEEDS
	public function movie_feeds_json($mvs_id, $usr_id = NULL, $offset = 0){
		
		$filters = array(
			'select' => '*',
			'from' => $this->_table_name,
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