<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Network extends User_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('user_m');
      
		}
    
    public function followers($slug = NULL){
      
			if($slug){
				
				$data = array('usr_nick' => $slug, 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$this->data['the_user'] = $this->user_m->get_userbox($data);
				
				if($this->data['the_user']){
					
					$this->data['controls'] = array('page' => 'flwr', 'owner' => TRUE);
	
					if($this->data['the_user']['owner_fl'] === 0)
						$this->data['controls']['owner'] = FALSE;

					$this->data['subview'] = 'user/network_list';
					$this->load->view('_main_body_layout', $this->data);
				
				}else{
					
					show_404();
					
				}
			
			}else{
				
				show_404();
				
			}
			
    }
		
		public function followings($slug = NULL){
      
			if($slug){
				
				$data = array('usr_nick' => $slug, 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$this->data['the_user'] = $this->user_m->get_userbox($data);
				
				if($this->data['the_user']){
					
					$this->data['controls'] = array('page' => 'flwg', 'owner' => TRUE);
	
					if($this->data['the_user']['owner_fl'] === 0)
						$this->data['controls']['owner'] = FALSE;
		
					$this->data['subview'] = 'user/network_list';
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