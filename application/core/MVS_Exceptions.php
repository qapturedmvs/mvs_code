<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVS_Exceptions extends CI_Exceptions{
  
    function __construct() {
		parent::__construct();
      
    }

    public function show_404(){
      
      $CI =& get_instance();
      $CI->load->view('pagenotfound');
      echo $CI->output->get_output();
      exit;
      
    }
}

?>