<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_Custom_List_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('user_custom_list_m');
      
		}
    
    public function list_lister(){
      
			if($this->input->is_ajax_request()){
				
				$json = (object) array();
				$lists = $this->user_custom_list_m->get_lists($this->user['usr_id']);
				
				if($lists){
					$json->result = 'OK';
					$json->total_count = $lists['total_count'];
					$json->data = $lists['data'];
				}else{
					$json->result = 'FALSE';
					$json->data = '';
				}
				
				$this->data['json'] = json_encode($json);
				
			}else{
				
				$this->data['json'] = FALSE;
				
			}
			
			$this->load->view('json/user_custom_list_json', $this->data);
			
    }
		
		public function edit_list_detail(){
			
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
					
					$vars = $this->input->post(NULL, TRUE);
					$data = array('list_id' => $vars['id'], 'usr_id' => $this->user['usr_id'], 'list_title' => $vars['title']);
						
					$this->data['ecl_result'] = $this->user_custom_list_m->edit_custom_list($data);
						
				}else{
					
					$this->data['ecl_result'] = 'no-user';
					
				}
				
			}else{
				
				$this->data['ecl_result'] = FALSE;
				
			}
			
			$this->load->view('results/_edit_custom_list_detail', $this->data);
			
		}
  
  }

?>