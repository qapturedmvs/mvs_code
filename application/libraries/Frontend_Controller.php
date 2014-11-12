<?php

	class Frontend_Controller extends MVS_Controller
	{
		public $get_vars = array();
		
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
			
			// Bütün query stringleri array içerisinde topla
			$this->get_vars = $this->input->get(NULL, TRUE);
			
		}
	}