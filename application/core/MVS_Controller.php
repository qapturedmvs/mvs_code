<?php
class MVS_Controller extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		
		// Loading mvs_adm_config file and admin settings table
		$this->config->load('mvs_adm_config');
		$this->load->model('admin/settings_m');
			
		// Set mvs_adm_config variables from db
		$db_data = $this->settings_m->settings();
		$sets = $db_data['data'];
		foreach($sets as $set){
			$this->config->set_item($set->adm_set_code, $set->adm_set_value);
		}
		
		// Global GET variables
		$this->get_vars = $this->input->get(NULL, TRUE);
		
		// Default Variables
		$this->data['site_url'] = site_url();
		$this->data['current_url'] = current_url();

	}
	
}

?>