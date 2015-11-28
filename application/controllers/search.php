<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
      $this->load->model('search_m');
			
		}
    
    public function index(){

			$this->data['keyword'] = $this->get_vars['q'];
			$this->data['subview'] = 'search';
			$this->load->view('_main_body_layout', $this->data);
      
    }
		
		public function movie(){

      $this->data['type'] = 'movie';
			$this->data['keyword'] = $this->get_vars['q'];
			$this->data['subview'] = 'search_detail';
			$this->load->view('_main_body_layout', $this->data);
      
    }
		
		public function star(){

      $this->data['type'] = 'star';
			$this->data['keyword'] = $this->get_vars['q'];
			$this->data['subview'] = 'search_detail';
			$this->load->view('_main_body_layout', $this->data);
      
    }
    
    public function user(){
			
			$this->data['type'] = (isset($this->get_vars['type'])) ? $this->get_vars['type'] : 'all';
			$this->data['keyword'] = $this->get_vars['q'];
			$this->data['subview'] = 'user/user_finder';
			$this->load->view('_main_body_layout', $this->data);
			
		}
    
  }
  
?>