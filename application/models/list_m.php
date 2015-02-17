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
	
	
  
}

?>