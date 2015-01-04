<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search extends Frontend_Controller{
		
		function __construct(){
			parent::__construct();
			
      $this->output->enable_profiler(TRUE);
      $this->load->model('search_m');
			
		}
    
    public function index($type = NULL){
      
      $keyword = $this->input->post('keyword', TRUE);
      $type = $this->input->get('type', TRUE);

      $limited = ($type == 'movie' || $type == 'star') ? FALSE : TRUE;
      $results = array('status' => 'none');
      
      if($keyword){ 
        if($type == 'movie' || $type == NULL){
          $results['movies'] = $this->_movies($keyword, $limited);
          $results['status'] = ($type == NULL) ? 'both' : 'movie';
        }
        
        if($type == 'star' || $type == NULL){
          $results['stars'] = $this->_stars($keyword, $limited);
          $results['status'] = ($type == NULL) ? 'both' : 'star';
        }
      }
      
      $this->data['results'] = $results;
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