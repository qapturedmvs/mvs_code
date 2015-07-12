<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Wall extends User_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('feed_m');
      
		}
    
    public function actions($slug = NULL){
      
			if($slug){
				
        $data = array('usr_nick' => $slug, 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
        $this->data['the_user'] = $this->feed_m->get_userbox($data);
        
        if($this->data['the_user']){
          
          $this->data['controls'] = array('page' => 'wall', 'owner' => TRUE);
          
          if($this->data['the_user']['owner_fl'] === 0)
            $this->data['controls']['owner'] = FALSE;
          
          // SET PAGE LOAD TIME
          $this->session->set_flashdata('page_loaded', date("Y-m-d H:i:s"));
  
          $this->data['subview'] = 'user/wall';
          $this->load->view('_main_body_layout', $this->data);
          
        }else{
          
          show_404();
          
        }
			
			}else{
				
				show_404();
				
			}
			
    }
  
  }

?>