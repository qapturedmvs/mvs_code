<?php

	class Frontend_Controller extends MVS_Controller
	{
	
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
		}
	}