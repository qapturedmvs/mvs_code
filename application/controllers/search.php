<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
      $this->output->enable_profiler(TRUE);
      $this->load->model('search_m');
			
		}
    
    public function index($type = NULL){
      
      $keyword = $this->input->post('keyword', TRUE);

			$this->data['keyword'] = $keyword;
			$this->data['subview'] = 'search';
			$this->load->view('_main_body_layout', $this->data);
      
    }
    
    private function _movies($keyword, $limited){
      
      $db_data = $this->search_m->find_movies($keyword, $limited);
      
      if($db_data)
        return $db_data['data'];
      else
        return $db_data;
    
    }
    
    private function _stars($keyword, $limited){
      
      $db_data = $this->search_m->find_stars($keyword, $limited);
      
      if($db_data)
        return $db_data['data'];
      else
        return $db_data;
      
    
    }
    
  }
  
?>