<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movies extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();

		}
    
    public function lister(){
			
			$this->data['subview'] = 'user/custom_list';
			$this->load->view('_main_body_layout', $this->data);
			
    }
		
		public function detail($list_id){
			
			if(is_numeric($list_id)){
				
				$this->load->model('user_custom_list_m');
				
				$list = $this->user_custom_list_m->get_list_detail($list_id, $this->user['usr_id']);
				
				if($list){
					
					$this->data['list'] = $list[0];
					$this->data['subview'] = 'user/custom_list_detail';
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