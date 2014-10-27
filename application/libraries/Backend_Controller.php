<?php

	class Backend_Controller extends MVS_Controller
	{
	
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper('form');
			$this->load->library('form_validation');
		}
	}