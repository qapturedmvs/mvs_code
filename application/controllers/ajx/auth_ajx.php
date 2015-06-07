<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Auth_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_m');
			
		}
		
		

	}

?>