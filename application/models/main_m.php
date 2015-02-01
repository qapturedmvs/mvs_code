<?php

class Main_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_users';
	protected $_primary_key = 'usr_id';
	protected $_order_by = 'usr_id';

	function __construct ()
	{
		parent::__construct();
	}


	
}