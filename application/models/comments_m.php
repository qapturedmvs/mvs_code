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
	public function movie_comments_json($mvs_id, $usr_id, $p = 0){

		$p = $this->cleaner($p);
		$offset = ($p-1) * $this->per_page;
			
		if($usr_id !== 0){		
			
			$filters = array(
				'select' => 'flwd_usr_id, u.usr_id, usr_name, usr_nick, usr_avatar, act_id, act_ref_id, act_type_id, act_text, act_time',
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
				'select' => 'act_id, act_ref_id, act_type_id, act_text, act_time, u.usr_id, usr_nick, usr_name, usr_avatar',
				'from' => 'mvs_feeds f',
				'join' => array('mvs_users u', 'u.usr_id = f.usr_id', 'inner'),
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
	
	// Custom List Comments
	public function customlist_comments_json($list_id, $usr_id, $p = 0){

		$p = $this->cleaner($p);
		$offset = ($p-1) * $this->per_page;
			
		if($usr_id !== 0){		
			
			$filters = array(
				'select' => 'u.usr_id, u.usr_name, u.usr_nick, usr_avatar, f.act_id, f.act_ref_id, f.act_type_id, f.act_text, f.act_time',
				'from' => 'mvs_follows fl',
				'join' => array(
										array('mvs_users u', 'u.usr_id = fl.flwd_usr_id', 'inner'),
										array('mvs_feeds f', "f.usr_id = fl.flwd_usr_id AND f.list_id = $list_id AND f.act_type_id = 4", 'inner')
									),
				'where' => "fl.flwr_usr_id = $usr_id",
				'order_by' => $this->_order_by.' DESC'
			);
			
			$feeds = $this->get_data(NULL, $offset, FALSE, $filters);
		
		}else{
			
			$filters = array(
				'select' => 'act_id, act_ref_id, act_type_id, act_text, act_time, u.usr_id, usr_nick, usr_name, usr_avatar',
				'from' => 'mvs_feeds f',
				'join' => array('mvs_users u', 'u.usr_id = f.usr_id', 'inner'),
				'where' => "list_id = $list_id AND f.act_type_id = 4",
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