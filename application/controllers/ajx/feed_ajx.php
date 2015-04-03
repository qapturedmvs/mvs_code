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

				//$feeds = $this->_build_feed_tree(json_decode(json_encode($feeds)));
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
		
		//private function _build_feed_tree(Array $data, $parent = 0){ 
		// 
		//	$tree = array();
		//	
		//	foreach ($data as $d){
		//		
		//		$d->feed_ref_id = ($d->feed_ref_id !== NULL) ? (int) $d->feed_ref_id : NULL;
		//		$d->feed_id = ($d->feed_id !== NULL) ? (int) $d->feed_id : NULL;
		//		
		//		if ($d->feed_ref_id == $parent){ 
		//			
		//			$children = $this->_build_feed_tree($data, $d->feed_id);
		//			
		//			if (!empty($children))
		//				$d->ref = $children;
		//		
		//			$tree[] = $d;
		//		 
		//		} 
		//		
		//		
		//		$d->feed_time = time_calculator($d->feed_time);
		//		
		//	}
		//	 
		//	return $tree;
		//}
		
		private function _build_feed_tree(Array $data){ 
		
			$tree = array();
			
			foreach($data as $ck => $cv){
				
				$cv['feed_time'] = time_calculator($cv['feed_time']);
				
				if($cv['mvs_poster'] === '1')
					$cv['mvs_poster'] = getCoverPath($cv['mvs_slug'], 'small');
				elseif($cv['mvs_poster'] === '0')
					$cv['mvs_poster'] = 'images/placeHolder.jpg';
				
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