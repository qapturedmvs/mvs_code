<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ajx_Controller extends Frontend_Controller
	{
		
		function __construct ()
		{
			parent::__construct();
			
			//if(!$this->input->is_ajax_request())
			//	show_404();
			
		}

	}