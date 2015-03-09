<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Network extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('user_m');
      
		}
    
    public function followers($slug = NULL){
      
			if($slug){
				
				$this->data['controls'] = array('page' => 'followers', 'owner' => TRUE);

				if((!$this->logged_in) || ($this->logged_in && $this->user['usr_nick'] !== $slug)){

					$this->data['the_user'] = $this->user_m->get_user_from_slug($slug, $this->user['usr_id'], 'profile');
					$this->data['controls']['owner'] = FALSE;
					
					if(!$this->data['the_user'])
						show_404();

				}
	
				$this->data['subview'] = 'user/network_list';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
    }
		
		public function followings($slug = NULL){
      
			if($slug){
				
				$this->data['controls'] = array('page' => 'followings', 'owner' => TRUE);

				if((!$this->logged_in) || ($this->logged_in && $this->user['usr_nick'] !== $slug)){

					$this->data['the_user'] = $this->user_m->get_user_from_slug($slug, $this->user['usr_id'], 'profile');
					$this->data['controls']['owner'] = FALSE;
					
					if(!$this->data['the_user'])
						show_404();

				}
	
				$this->data['subview'] = 'user/network_list';
				$this->load->view('_main_body_layout', $this->data);
			
			}else{
				
				show_404();
				
			}
			
    }
  
  }

?>