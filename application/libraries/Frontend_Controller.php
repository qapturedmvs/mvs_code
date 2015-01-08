<?php

	class Frontend_Controller extends MVS_Controller
	{
		protected $get_vars = array();
		protected $data = array();
		
		// TEMP
		protected $filter_def = array('like' => array('mfc' => array('cntry_id', 'countries', 'cntry_title'), 'mfg' => array('gnr_id', 'genres', 'gnr_title')), 'between' => array('mfr' => 'mvs_rating', 'mfy' => 'mvs_year'), 'equal' => array('mfa' => array('aud_id', 'audience')));
		
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
			$this->data['site_name'] = $this->config->item('mvs_site_name');
			
		}
	}