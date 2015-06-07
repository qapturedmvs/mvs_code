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
  
	public function seen_movie($data){
		
		if($data['action'] === 'seen'){
			
			unset($data['action']);
			$out = array('@seen_id' => NULL);
			$this->db->call_procedure('sp_seen_single', $data, $out);
			$result = $out['@seen_id'];

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
	
	public function add_remove_watchlist($data){
		
		if($data['action'] === 'awtc'){
			
			unset($data['action']);
			$out = array('@wtc_id' => NULL);
			$this->db->call_procedure('sp_addto_watchlist', $data, $out);
			$result = $out['@wtc_id'];

		}else{
			
			$this->db->where('wtc_id = '.$data['wtc_id'].' AND usr_id = '.$data['usr_id']);
			$this->db->delete('mvs_watchlist');
			$result = 'rwtc';
			
		}
		
		return $result;
		
	}
	
	public function get_movie_actions($data){
		
		$filters = array(
			'select' => 'cl.list_id, cl.list_title, cld.ldt_id, s.seen_id, w.wtc_id, a.app_id',
			'from' => 'mvs_users u',
			'join' => array(
				array('mvs_custom_lists cl', 'cl.usr_id = u.usr_id', 'left'),
				array('mvs_custom_list_data cld', 'cld.list_id = cl.list_id AND cld.mvs_id = '.$data['mvs_id'], 'left'),
				array('mvs_seen s', 's.usr_id = u.usr_id AND s.mvs_id = '.$data['mvs_id'], 'left'),
				array('mvs_watchlist w', 'w.usr_id = u.usr_id AND w.mvs_id = '.$data['mvs_id'], 'left'),
				array('mvs_applaud a', 'a.usr_id = u.usr_id AND a.mvs_id = '.$data['mvs_id'], 'left')
				),
			'where' => 'u.usr_id = '.$data['usr_id'],
			'order_by' => 'cl.list_time DESC'
		);
		
		$cl = $this->get_data(NULL, 0, FALSE, $filters);
		
		if(isset($cl['data']))
			return $cl['data'];
		else
			return FALSE;
		
	}
	
		public function applaud_movie($data){
		
		if($data['action'] === 'applaud'){
			
			unset($data['action']);
			$out = array('@app_id' => NULL);
			$this->db->call_procedure('sp_applaud_movie', $data, $out);
			$result = $out['@app_id'];

		}else{

			$this->db->where('app_id = '.$data['app_id'].' AND usr_id = '.$data['usr_id']);
			$this->db->delete('mvs_applaud');
			$result = 'unapplaud';
			
		}
		
		return $result;
	
	}
  
}

?>