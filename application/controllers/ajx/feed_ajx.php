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
//var_dump($feeds);
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
      
    }
		
		private function _build_feed_tree(Array $data){ 
		
			$tree = array();
			
			foreach($data as $ck => $cv){
				
				$cv['feed_time'] = time_calculator($cv['feed_time']);
				
				if($cv['mvs_poster'] === '1')
					$cv['mvs_poster'] = getCoverPath($cv['mvs_slug'], 'small');
				elseif($cv['mvs_poster'] === '0')
					$cv['mvs_poster'] = 'images/placeHolder.jpg';
				
				$cv['usr_avatar'] =  ($cv['usr_avatar'] == '') ? 'images/user.jpg' : $cv['usr_avatar'];
				$cv['owner'] = ($cv['usr_id'] == $this->user['usr_id']) ? 1 : 0;
				
				if($cv['feed_type'] === 'rf'){
					
					foreach($data as $pk => $pv){
						
						if($pv['feed_type'] === 'rv' && $pv['feed_id'] == $cv['feed_ref_id']){

							if(isset($tree[$pk])){
								
								$tree[$pk]['ref'][] = $cv;
								
							}else{
							
								$pv['ref'][] = $cv;
								$tree[$pk] = $pv;
							
							}
							
							$tree[$pk]['feed_time'] = time_calculator($tree[$pk]['feed_time']);
							
							if($tree[$pk]['mvs_poster'] === '1')
								$tree[$pk]['mvs_poster'] = getCoverPath($tree[$pk]['mvs_slug'], 'small');
							elseif($tree[$pk]['mvs_poster'] === '0')
								$tree[$pk]['mvs_poster'] = 'images/placeHolder.jpg';
								
							$tree[$pk]['usr_avatar'] =  ($tree[$pk]['usr_avatar'] == '') ? 'images/user.jpg' : $tree[$pk]['usr_avatar'];
							$tree[$pk]['owner'] = ($tree[$pk]['usr_id'] == $this->user['usr_id']) ? 1 : 0;
							
						}
						
					}
					
				}else{
					
					if(!isset($tree[$ck]))
						$tree[$ck] = $cv;
					
				}
				
			}
			
			ksort($tree);
			
			return $tree;
		}
  
  }

?>