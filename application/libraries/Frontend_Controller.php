<?php

	class Frontend_Controller extends MVS_Controller
	{
		public $get_vars = array();
		
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
			
			// B�t�n query stringleri array i�erisinde topla
			$this->get_vars = $this->input->get(NULL, TRUE);
			
		}
	}