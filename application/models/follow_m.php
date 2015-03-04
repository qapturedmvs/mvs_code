<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follow_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_follows';
	protected $_primary_key = 'flw_id';
	protected $_order_by = 'flw_time';
	public $per_page = 0;
  
	function __construct (){
		parent::__construct();
	}
  
  public function follow_unfollow($data){

    if($data['action'] === 'follow'){
      unset($data['action']);
      $this->db->insert('mvs_follows', $data);
      $result = $this->db->insert_id();
    }else{
      $this->db->where('flw_id = '.$data['flw_id'].' AND flwr_usr_id = '.$data['flwr_usr_id']);
      $this->db->delete('mvs_follows');
      $result = 'unfollow';
    }
    
    return $result;
		
	}
  
}

?>