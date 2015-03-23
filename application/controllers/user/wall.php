<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Wall extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('feed_m');
      
		}
    
    public function actions($slug = NULL){
      
			if($slug){
				
				$this->data['controls'] = array('page' => 'wall', 'owner' => TRUE);
				
				if((!$this->logged_in) || ($this->logged_in && $this->user['usr_nick'] !== $slug)){
          
          $this->data['the_user'] = $this->feed_m->get_user_from_slug($slug, $this->user['usr_id'], 'profile');
					$this->data['controls']['owner'] = FALSE;
					
					if(!$this->data['the_user'])
						show_404();
					
				}else{
					

						
				}

				$this->data['subview'] = 'user/wall';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
    }
  
  }

?>