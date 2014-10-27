<?php

	class Backend_Controller extends MVS_Controller
	{
	
		function __construct ()
		{
			parent::__construct();
			
			// Login check
			$exception_uris = array('admin/user/login', 'admin/user/logout');
			
			if (in_array(uri_string(), $exception_uris) == FALSE) {
				if ($this->user_m->loggedin() == FALSE) {
					redirect('admin/user/login');
				}
			}

		}
	}