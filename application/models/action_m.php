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
		
		$data['mvs_id'] = $this->cleaner($data['mvs_id']);
		$data['seen_id'] = $this->cleaner($data['seen_id']);
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_single_seen', $data, $out);
		$result = $out['@result'];
		
		return $result;
	
	}
	
	public function bulk_action($data, $act){
		
		$act = $this->cleaner($act);
		$data['mvs'] = $this->cleaner($data['mvs']);
		$data['mvs_c'] = $this->cleaner($data['mvs_c']);
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_multi_'.$act, $data, $out);
		$result = $out['@result'];
		
		return $result;
	
	}
	
	public function get_user_seen($usr_id){
		
		$str = "SELECT seen_id id, mvs_id, 'sn' AS list_type FROM mvs_seen WHERE usr_id = $usr_id UNION ALL SELECT wtc_id id, mvs_id, 'wt' AS list_type FROM mvs_watchlist WHERE usr_id = $usr_id";
		$seen = $this->db->query($str);
		
		if($result = $seen->result())
			return $result;
		else
			return FALSE;
		
	}
	
	public function add_remove_watchlist($data){
		
		$data['mvs_id'] = $this->cleaner($data['mvs_id']);
		$data['wtc_id'] = $this->cleaner($data['wtc_id']);
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_single_watchlist', $data, $out);
		$result = $out['@result'];
		
		return $result;
		
	}
	
		
	public function add_remove_from_customlist($data){
		
		$data['mvs_id'] = $this->cleaner($data['mvs_id']);
		$data['list_id'] = $this->cleaner($data['list_id']);
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_single_customlist', $data, $out);
		$result = $out['@result'];
		
		return $result;
		
	}
	
	public function get_user_md_customlists($data){
		
		$data['mvs_id'] = $this->cleaner($data['mvs_id']);
		$result = $this->db->call_procedure('sp_get_user_md_customlists', $data);
		
		return $result;
		
	}
	
	public function get_md_myn_seen_users($data){
		
		$data['mvs'] = $this->cleaner($data['mvs']);
		$users = $this->db->call_procedure('sp_md_myn_seen_users', $data);

		if($users)
			return $users;
		else
			return FALSE;
		
	}
	
	public function applaud_movie($data){
		
		$data['mvs_id'] = $this->cleaner($data['mvs_id']);
		$data['app_id'] = $this->cleaner($data['app_id']);
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_single_applaud', $data, $out);
		$result = $out['@result'];
		
		return $result;
	
	}
  
}

?>