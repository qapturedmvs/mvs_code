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

		if($usr_id != NULL){		
			
			$filters = array(
				'select' => 'flwd_usr_id, u.usr_id, usr_name, usr_nick, act_id, act_ref_id, act_type_id, act_text, act_time',
				'from' => 'mvs_follows fl',
				'join' => array(
										array('mvs_users u', 'u.usr_id = fl.flwd_usr_id', 'inner'),
										array('mvs_feeds f', "f.usr_id = fl.flwd_usr_id AND f.mvs_id = $mvs_id", 'inner')
									),
				'where' => "fl.flwr_usr_id = $usr_id",
				'order_by' => $this->_order_by.' DESC'
			);
			
			$feeds = $this->get_data(NULL, $offset, FALSE, $filters);
		
		}else{
			
			$filters = array(
				'select' => 'act_id,act_ref_id,act_type_id,act_text,act_time,u.usr_id,usr_nick,usr_name',
				'from' => 'mvs_feeds f',
				'join' => array('mvs_users u', 'f.usr_id = u.usr_id', 'inner'),
				'where' => "mvs_id = $mvs_id",
				'order_by' => $this->_order_by.' DESC'
			);
			
			$feeds = $this->get_data(NULL, $offset, TRUE, $filters);
			
		}

		if(isset($feeds['data']))
			return $feeds;
		else
			return FALSE;
	
	}
  
  
}

?>