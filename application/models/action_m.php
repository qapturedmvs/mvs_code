<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_feeds';
	protected $_primary_key = 'act_id';
	protected $_order_by = 'act_time';
	public $per_page = 0;
  
	function __construct (){
		parent::__construct();
	}
  
	public function add_comment($data){
		
		$this->db->insert($this->_table_name, $data);
		
		return $this->db->insert_id();
	
	}
  
	public function seen_movie($data){
		
		if($data['action'] === 'seen'){
			unset($data['action']);
			$this->db->insert('mvs_seen', $data);
			$result = $this->db->insert_id();
		}else{
			$this->db->where('seen_id = '.$data['seen_id'].' AND usr_id = '.$data['usr_id']);
			$this->db->delete('mvs_seen');
			$result = 'unseen';
		}
		
		return $result;
	
	}
	
	public function seen_movie_multi($data){
		
		$this->db->insert_batch('mvs_seen', $data);
		
		return 'mseen';
	
	}
	
	public function get_user_seen($usr_id){
		
		$filters = array(
			'select' => 'seen_id, mvs_id',
			'from' => 'mvs_seen',
			'where' => 'usr_id = '.$usr_id
		);
		
		$seen = $this->get_data(NULL, 0, TRUE, $filters);
		
		if(isset($seen['data']))
			return $seen;
		else
			return FALSE;
		
	}
	
	public function check_seen($data){
		
		$filters = array(
			'select' => '*',
			'from' => 'mvs_seen',
			'where' => 'usr_id = '.$data['usr_id'].' AND mvs_id = '.$data['mvs_id'],
			'limit' => 1
		);
		
		$seen = $this->get_data(NULL, 0, FALSE, $filters);
		
		if(isset($seen['data']))
			return $seen['data'];
		else
			return FALSE;
		
	}
	
	public function check_watchlist($data){
		
		$filters = array(
			'select' => '*',
			'from' => 'mvs_watchlist',
			'where' => 'usr_id = '.$data['usr_id'].' AND mvs_id = '.$data['mvs_id'],
			'limit' => 1
		);
		
		$wtc = $this->get_data(NULL, 0, FALSE, $filters);
		
		if(isset($wtc['data']))
			return $wtc['data'];
		else
			return FALSE;
		
	}
	
	public function add_remove_watchlist($data){
		
		if($data['action'] === 'awtc'){
			unset($data['action']);
			$this->db->insert('mvs_watchlist', $data);
			$result = $this->db->insert_id();
		}else{
			$this->db->where('wtc_id = '.$data['wtc_id'].' AND usr_id = '.$data['usr_id']);
			$this->db->delete('mvs_watchlist');
			$result = 'rwtc';
		}
		
		return $result;
		
	}
	
	public function create_delete_list($data){
		
		if($data['action'] === 'cncl'){
			unset($data['action']);
			$this->db->insert('mvs_custom_lists', $data);
			$result = $this->db->insert_id();
		}else{
			$this->db->where('list_id = '.$data['list_id'].' AND usr_id = '.$data['usr_id']);
			$this->db->delete('mvs_custom_lists');
			$result = 'dcl';
		}
		
		return $result;
		
	}
	
  
}

?>