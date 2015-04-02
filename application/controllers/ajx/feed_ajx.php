<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feed_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('feed_m');
      
		}
    
    public function index(){ show_404(); }
    
    public function wall($p = 1){
      
			$json = (object) array();
			$data = array('nick' => $this->get_vars['nick'], 'p' => $p);
      $feeds = $this->feed_m->wall_json($data);
      
      if($feeds){

				$feeds = $this->_build_feed_tree($feeds);

        $json->result = 'OK';
        $json->data = $feeds;
      }else{
        $json->result = 'FALSE';
        $json->data = '';
      }

			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
      
    }
		
		private function _build_feed_tree(Array $data){ 

			$tree = array();
			
			foreach($data as $ck => $cv){
				
				if($cv['feed_type'] === 'rf'){
					
					foreach($data as $pk => $pv){
						
						if($pv['feed_type'] === 'rv' && $pv['feed_id'] == $cv['feed_ref_id']){
							
							if(isset($tree[$pk])){
								
								$tree[$pk]['ref'][] = $cv;
								
							}else{
							
								$pv['ref'][] = $cv;
								$tree[$pk] = $pv;
							
							}
							
						}
						
					}
					
				}else{
					
					if(!isset($tree[$ck])){
						
						$tree[$ck] = $cv;
						
					}
					
				}
				
			}

			return $tree;
		}
  
  }

?>