<?php

	class Frontend_Controller extends MVS_Controller
	{
		protected $get_vars = array();
		protected $data = array();
		
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
			$this->data['site_name'] = $this->config->item('mvs_site_name');
			
		}
	}