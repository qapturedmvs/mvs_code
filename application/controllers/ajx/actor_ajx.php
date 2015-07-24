<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Actor_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			
			$this->load->model('actor_m');
		}
		
		public function index(){ show_404(); }
		
		public function graph($slug = NULL){
				
				if($slug){
					
					$vars = $this->get_vars;
					$data = array('slug' => $slug);
					$gps = $this->actor_m->get_actor_graph($data);
					$json = (object) array();
					
					if($gps){
						
						$json->result = 'OK';
						$json->data = $gps;
						
					}else{
						
						$json->result = 'FALSE';
						$json->data = '';
						
					}
					
					$this->data['json'] = json_encode($json);
					$this->load->view('json/main_json_view', $this->data);
				
				}else{
					
					show_404();
					
				}
			
		}
		
		public function test_cnt_func(){
			
			$this->actor_m->test_func(array('year' => 1995));
			
		}
	

	}

?>