<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_M extends MVS_Model
{
  
  protected $_table_name = 'mvs_static_pages';
	protected $_primary_key = 'stp_id';
	public $per_page = 10;
  
	function __construct (){
		parent::__construct();
	}
  
  public function get_pages(){
   
		$filters = array(
			'select' => '*',
			'from' => 'mvs_static_pages',
			'order_by' => 'stp_sort ASC'
		);

		$pages = $this->get_data(NULL, 0, FALSE, $filters);
	
		if(isset($pages['data']))
			return $pages['data'];
		else
			return FALSE;
   
  }

  
}

?>