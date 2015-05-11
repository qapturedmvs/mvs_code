<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
      $this->output->enable_profiler(TRUE);
      $this->load->model('search_m');
			
		}
    
    public function index(){
      
      $keyword = $this->input->post('keyword', TRUE);

			$this->data['keyword'] = $keyword;
			$this->data['subview'] = 'search';
			$this->load->view('_main_body_layout', $this->data);
      
    }
    
    public function movies(){
      
    }
    
    public function user(){
			
			$keyword = $this->input->post('keyword', TRUE);

			$this->data['keyword'] = $keyword;
			$this->data['subview'] = 'user/user_finder';
			$this->load->view('_main_body_layout', $this->data);
			
		}
    
  }
  
?>