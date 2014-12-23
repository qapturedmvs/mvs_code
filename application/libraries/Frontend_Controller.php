<?php

	class Frontend_Controller extends MVS_Controller
	{
		protected $get_vars = array();
		protected $data = array();
		
		// TEMP
		protected $filter_def = array('like' => array('mfc' => 'cntry_id', 'mfg' => 'gnr_id'), 'between' => array('mfr' => 'mvs_rating', 'mfy' => 'mvs_year'), 'equal' => array('mfa' => 'aud_id'));
		
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
			$this->data['site_name'] = $this->config->item('mvs_site_name');
			
		}
	}