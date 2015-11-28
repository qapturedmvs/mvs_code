<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class About extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('pages_m');

		}

		public function _remap($method,$args){
		
			if (method_exists($this, $method))
				$this->$method($args);
			else
				$this->index($method,$args);
			
		}
	
		public function index($slug = NULL){
      
			$pages = $this->pages_m->get_pages();
			$exist = FALSE;
			
			foreach($pages as $page){
				
				if($page->stp_slug == $slug){
					$exist = TRUE;
					$this->data['active'] = array('title' => $page->stp_title, 'slug' => $page->stp_slug);
					break;
				}
				
			}
      
			if($exist){
				
				// Load view
				$this->data['pages'] = $pages;
				$this->data['subview'] = 'pages/_main_static_page_view';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
    }
    
  }
  
?>