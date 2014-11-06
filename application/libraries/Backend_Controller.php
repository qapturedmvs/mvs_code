<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Backend_Controller extends MVS_Controller
	{
		
		public $data = array();
	
		function __construct ()
		{
			parent::__construct();	
			
			$this->output->enable_profiler();
			$this->load->model('admin/user_m');
			$this->load->helper(array('form', 'mvs_helper'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

			// Login check
			$exception_uris = array('admin/user/login', 'admin/user/logout');
			
			if (in_array(uri_string(), $exception_uris) == FALSE) {
				if ($this->user_m->loggedin() == FALSE) {
					redirect('admin/user/login');
				}
			}
			
			// Loading mvs_adm_config file and admin settings table
			$this->config->load('mvs_adm_config');
			$this->load->model('admin/settings_m');
			
			// Set mvs_adm_config variables from db
			$sets = $this->settings_m->get();
			foreach($sets as $set){
				$this->config->set_item($set->adm_set_code, $set->adm_set_value);
			}
			
			// Default Variables
			$this->data['site_url'] = site_url();
			$this->data['current_url'] = current_url();

		}
		
	}