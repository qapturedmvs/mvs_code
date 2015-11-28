<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customlist_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_custom_lists';
	protected $_primary_key = 'list_id';
	protected $_order_by = 'list_time';
	public $per_page = 100;
  
	function __construct (){
		parent::__construct();
	}
  
	// User Custom Lists (User Movie Lists)
	public function get_lists($usr){
		
		$lists = $this->db->call_procedure('sp_get_user_customlists', $usr);
		
		if($lists)
			return $lists;
		else
			return FALSE;
		
	}
	
	public function get_customlist_detail($data){

		$cl = $this->db->call_procedure('sp_get_customlist', $data);

		if($cl)
			return $cl[0];
		else
			return FALSE;
		
	}
	
	public function create_customlist($data){

		$out = array('@list_id' => NULL, '@ldt_id' => NULL);
		$this->db->call_procedure('sp_new_customlist', $data, $out);
		$result = array('list_id' => $out['@list_id'], 'ldt_id' => $out['@ldt_id']);

		return $result;
		
	}
	
		public function delete_customlist($data){
		
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_delete_customlist', $data, $out);
		$result = $out['@result'];

		return $result;
		
	}
	
	// Movie Detail Custom Lists
	public function get_custom_lists($data){
		
		$filters = array(
			'select' => 'cl.list_id, cl.list_title, cld.ldt_id',
			'from' => 'mvs_custom_lists cl',
			'join' => array('mvs_custom_list_data cld', 'cld.list_id = cl.list_id AND cld.mvs_id = '.$data['mvs_id'], 'left'),
			'where' => 'cl.usr_id = '.$data['usr_id'],
			'order_by' => 'cl.list_time DESC'
		);
		
		$cl = $this->get_data(NULL, 0, FALSE, $filters);
		
		if(isset($cl['data']))
			return $cl['data'];
		else
			return FALSE;
		
	}
	
	public function edit_custom_list($data){
		
		$cl = $this->db->call_procedure('sp_edit_customlist_detail', $data);

		if($cl)
			return $cl;
		else
			return FALSE;
	
	}

	public function rate_customlist($data){
			
		$data['item_id'] = $this->cleaner($data['item_id']);
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_rate_item', $data, $out);
		$result = $out['@result'];
		
		return $result;
	
	}
	
	public function get_movie_customlists($data){
		
		$lists = $this->db->call_procedure('sp_get_movie_customlists', $data);

		if($lists)
			return $lists;
		else
			return FALSE;
		
	}
	
	
	// Get users add to list menu
	public function get_add_cls_menu($data){
		
		$lists = $this->db->call_procedure('sp_get_user_add_cls_menu', $data);
		
		if($lists)
			return $lists;
		else
			return FALSE;
		
	}
	
  
}

?>