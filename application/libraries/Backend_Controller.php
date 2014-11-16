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
			$this->load->library(array('form_validation', 'pagination'));
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

			// Login check
			$exception_uris = array('admin/user/login', 'admin/user/logout');
			
			if (in_array(uri_string(), $exception_uris) == FALSE) {
				if ($this->user_m->loggedin() == FALSE) {
					redirect('admin/user/login');
				}
			}

		}
		
		public function _get_paging($total, $perPage, $path, $uri){
		
			$config['base_url'] = site_url().$path;
			$config['total_rows'] = $total;
			$config['per_page'] = $perPage;
			$config['uri_segment'] = $uri;
			$config['num_links'] = 5;
			$config['use_page_numbers'] = TRUE;
			$config['suffix'] = getVars($this->get_vars);
			$config['first_url'] = $config['base_url'].$config['suffix'];
			
			$config['first_link'] = '&lt;&lt;';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = '&gt;&gt;';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = '&gt;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&lt;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><span>';
			$config['cur_tag_close'] = '</span></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
		
			$this->pagination->initialize($config);
		
			return $this->pagination->create_links();
		}
		
	}