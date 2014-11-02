<?php

class Settings_M extends MVS_Model
{


	protected $_table_name = 'mvs_adm_settings';
	protected $_primary_key = 'adm_set_group';
	protected $_order_by = 'adm_set_id';
	protected $_order_rule = 'ASC';

	function __construct ()
	{
		parent::__construct();

	}
	
	public function settings($id = NULL, $offset = 0){
	
		$settings = $this->get($id, FALSE, $offset);
	
		if (count($settings))
			return $settings;
		else
			return FALSE;
	
	}
	
}