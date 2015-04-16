<?php
class MVS_Controller extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		
		// Loading mvs_config file and admin settings table
		$this->config->load('mvs_config');
		//$this->load->model('admin/settings_m');
		$this->load->driver('cache', $this->config->item('cache_sets'));
		
		//if(!$sets = $this->cache->get('mvs_settings')){
		//		$db_data = $this->settings_m->settings();
		//		$sets = $db_data['data'];
		//		$this->cache->save('mvs_settings', $sets, 600);
		//}
		//
		//foreach($sets as $set){
		//	$this->config->set_item($set->adm_set_code, $set->adm_set_value);
		//}
		
		// Global GET variables
		$this->get_vars = $this->input->get(NULL, TRUE);
		
		// Default Variables
		$this->data['site_url'] = site_url();
		$this->data['current_url'] = current_url();
		$this->data['referer_url'] = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : FALSE;

	}
	
			
	protected function _send_mail($email, $type){
		
		$this->load->library('email');
		
		$this->email->from('qaptured@altugorsmen.com', 'Qaptured');
		$this->email->to($email);
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class. Mail type is: '.$type);
		
		//$this->email->send();
		
		//echo $this->email->print_debugger();
		
	}
	
}

?>