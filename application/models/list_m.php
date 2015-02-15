<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class List_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_list';
	protected $_primary_key = 'list_id';
	protected $_order_by = 'list_time';
	public $per_page = 0;
  
	function __construct (){
		parent::__construct();
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
  
}

?>