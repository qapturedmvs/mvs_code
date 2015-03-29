<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Frontend_Controller extends MVS_Controller
	{
		protected $get_vars = array();
		protected $data = array();
		protected $user = NULL;
		protected $logged_in = FALSE;
		protected $_timestamp = '';
		
		// TEMP
		protected $filter_def = array('like' => array('mfc' => array('cntry_id', 'countries', 'cntry_title'), 'mfg' => array('gnr_id', 'genres', 'gnr_title')), 'between' => array('mfr' => 'mvs_rating', 'mfy' => 'mvs_year'), 'network' => array('mfn' => 'network'));
		
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
			$this->data['site_name'] = $this->config->item('mvs_site_name');
			$this->_timestamp = $this->config->item('mvs_db_time');

			// CHECK USER LOGGED IN
			$this->logged_in = $this->data['logged_in'] = (bool) $this->session->userdata('usr_loggedin');
			
			if($this->logged_in === TRUE)
				$this->user = $this->data['user'] = $this->session->all_userdata();

		}
		
		protected function session_check(){
				
			if($this->logged_in === FALSE)
				redirect('', 'refresh');
			
		}
		
		protected function cache_table_data($table, $model, $fields){
			
			$data = array();

			if(!$data = $this->cache->get($table)){
					$db_data = $this->{$model}->{$table}();
					
					foreach($db_data as $d)
						$data[$d->{$fields['id']}] = $d->{$fields['title']};
					
					$this->cache->save($table, $data, 600);
			}
			
			return $data;
		
		}
		
	}