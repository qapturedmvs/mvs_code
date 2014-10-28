<?php
class MVS_Controller extends CI_Controller {
	
	public $data = array();
	
	function __construct() {
		parent::__construct();
		$data['site_name'] = "Qaptured";
	}
}

?>