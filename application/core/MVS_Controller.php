<?php
class MVS_Controller extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		
		// Loading mvs_adm_config file and admin settings table
		$this->config->load('mvs_adm_config');
		$this->load->model('admin/settings_m');
		//$this->load->driver('cache', array('adapter' => 'file', 'backup' => 'memcached'));
			
		// Set mvs_adm_config variables from db
		//$sets = $this->cache->get('mvs_settings');
		
		//if(!$sets){
			
		$db_data = $this->settings_m->settings();
		$sets = $db_data['data'];
		
			//$this->cache->save('mvs_settings', $sets, 600);
			
		//}
		
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