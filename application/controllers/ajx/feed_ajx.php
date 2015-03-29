<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feed_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('feed_m');
      
		}
    
    public function index(){ show_404(); }
    
    public function wall($p = 1){
      
			$json = (object) array();
      $p = $this->feed_m->cleaner($p);
      $offset = ($p-1) * $this->feed_m->per_page;
			$data = array('nick' => 7, 'offset' => $offset);
			//$data = array('nick' => $this->get_vars['nick'], 'offset' => $offset);
      $feeds = $this->feed_m->wall_json($data);
      
      if($feeds){
				
				//$feeds = $this->_build_feed_tree($feeds);
				
        $json->result = 'OK';
        $json->data = $feeds;
      }else{
        $json->result = 'FALSE';
        $json->data = '';
      }

      $data['json'] = json_encode($json);
      
      $this->load->view('json/main_json_view', $data);
      
    }
		
		private function _build_feed_tree(Array $data, $parent = 0){ 

			$tree = array();
			
			foreach ($data as $d){
				
				if($d['feed_act_ref_id'] !== NULL && $d['feed_act_ref_id'] == $parent){ 
					
					$children = $this->_build_feed_tree($data, $d['feed_act_id']);
					
					if(!empty($children))
						$d['reply'] = $children;
				
					$tree[] = $d;
				 
				}
				
				$d['feed_time'] = time_calculator($d['feed_time']);
				
			}
			 
			return $tree;
		}
  
  }

?>