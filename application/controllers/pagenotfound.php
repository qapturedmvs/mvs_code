<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Pagenotfound extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			show_404();
      
		}
    
  }
  
?>