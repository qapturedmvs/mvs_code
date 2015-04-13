<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feed_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();

			$this->load->model('feed_m');
      
		}
    
    public function index(){ show_404(); }
    
    public function wall($p = 1){
      
			$json = (object) array();
			$data = array('nick' => $this->get_vars['nick'], 'login_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'p' => $p);
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
		
		public function get_more_refs(){
			
			$json = (object) array();
			$data = array('act_ref' => $this->get_vars['ref'], 'login_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
      $feeds = $this->feed_m->more_review_json($data);
      
      if($feeds){
				
				foreach($feeds as $feed)
					$feed = $this->_prepare_feed_data($feed);

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
				
				$cv = $this->_prepare_feed_data($cv);
				
				if($cv['feed_type'] === 'rf'){
					
					foreach($data as $pk => $pv){
						
						if($pv['feed_type'] === 'rv' && $pv['feed_id'] == $cv['feed_ref_id']){

							if(isset($tree[$pk])){
								
								$tree[$pk]['ref'][] = $cv;
								
							}else{
							
								$pv['ref'][] = $cv;
								$tree[$pk] = $this->_prepare_feed_data($pv);
							
							}
							
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
		
		private function _prepare_feed_data($feed){
			
			$feed['feed_ago'] = time_calculator($feed['feed_time']);
				
			if($feed['mvs_poster'] === '1')
				$feed['mvs_poster'] = getCoverPath($feed['mvs_slug'], 'small');
			elseif($feed['mvs_poster'] === '0')
				$feed['mvs_poster'] = 'images/placeHolder.jpg';
			
			$feed['usr_avatar'] =  ($feed['usr_avatar'] == '') ? 'images/user.jpg' : $feed['usr_avatar'];
			$feed['owner'] = ($feed['usr_id'] == $this->user['usr_id']) ? 1 : 0;
			
			return $feed;
			
		}
  
  }

?>