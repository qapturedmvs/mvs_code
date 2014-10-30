<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Backend_Controller extends MVS_Controller
	{
	
		function __construct ()
		{
			parent::__construct();
			
			// Default Variables
			$this->data['site_name'] = "Qaptured";
			$this->data['site_url'] = site_url();
			$this->data['current_url'] = current_url();
			
			$this->load->helper(array('form', 'mvs_helper'));
			$this->load->library('form_validation');
			$this->load->model('admin/user_m');
			
			// Login check
			$exception_uris = array('admin/user/login', 'admin/user/logout');
			
			if (in_array(uri_string(), $exception_uris) == FALSE) {
				if ($this->user_m->loggedin() == FALSE) {
					redirect('admin/user/login');
				}
			}

		}
		
		public function paging($total, $perPage, $curPage, $linkCount){
			
			$totalPage = ceil($total/$perPage);
			$bLinks = ceil($linkCount/2);
			$aLinks = $linkCount-$bLinks;

			
		}
	}