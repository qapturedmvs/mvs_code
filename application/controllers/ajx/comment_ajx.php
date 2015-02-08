<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Comment_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('action_m');
			
		}
    
    public function add_comment(){
      
			if($this->input->is_ajax_request()){
				
				if(isset($this->user['usr_id'])){
				
					$vars = $this->input->post(NULL, TRUE);
					$data = array('act_type_id' => (int) $vars['type'], 'act_text' => $vars['text'], 'usr_id' => $this->user['usr_id']);
					$col = '';
					
					switch((int) $vars['type']) {
						case 2:
								$col = 'mvs_id';
								break;
						case 7:
								$col = 'act_ref_id';
								break;
					}
					
					$data[$col] = $vars['id'];
					$feed = $this->action_m->add_comment($data);
					
					if($feed){
						
						$this->data['feed'] = $feed;
						$this->data['comment_result'] = 'success';
						
					}else{
						
						$this->data['comment_result'] = 'error';
						
					}
				
				}else{
					
					$this->data['comment_result'] = 'no-user';
					
				}
			
			}else{
				
				$this->data['comment_result'] = FALSE;
				
			}
				
			$this->load->view('json/comment_json', $this->data);
			
    }
  
  }

?>