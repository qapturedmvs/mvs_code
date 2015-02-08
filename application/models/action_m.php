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
		
		$this->db->insert('mvs_feeds', $data);
		
		return $this->db->insert_id();
	
	}
  
  
}

?>