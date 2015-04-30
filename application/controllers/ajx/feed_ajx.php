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

				$feeds = $this->_build_wall_tree($feeds);
        $json->result = 'OK';
        $json->data = $feeds;
				
      }else{
				
        $json->result = 'FALSE';
        $json->data = '';
				
      }

			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
      
    }
		
		public function feeds($p = 1){
      
			$json = (object) array();
			$data = array('usr' => $this->user['usr_id'], 'p' => $p);
      $feeds = $this->feed_m->feeds_json($data);

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
		
		public function get_more_replies($act_id){
			
			$data = array('act_ref' => $act_id, 'login_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
      $feeds = $this->feed_m->get_more_replies($data);
      
      if($feeds){

				foreach($feeds as $key => $feed){
					$feeds[$key] = $this->_prepare_wall_data($feed);

				}

      }

			$this->data['feeds'] = $feeds;
			$this->load->view('html_results/_more_replies', $this->data);
			
		}
		
		private function _build_wall_tree(Array $data){ 
		
			$tree = array();

			foreach($data as $k => $d){
				
				if($d['feed_type'] == 'rf'){
					
					foreach($tree as $tk => $tv){
						
						if($tv['feed_id'] == $d['feed_ref_id'])
							$tree[$tk]['ref'][] = $this->_prepare_wall_data($d);
						
					}
					
				}else{
					
					$tree[] = $this->_prepare_wall_data($d);
					
				}
				
			}
			
			return $tree;
		}
		
		private function _build_feed_tree($data){
			
			$tree = array();
			
			foreach($data as $k => $d){
				
				if($d['feed_type'] == 'sn'){
					
					if((int) $d['total_seen'] > 1){
						
						$i = 1;
						unset($data[$k]);
						
						foreach($data as $sk => $sv){
							
							if($sv['feed_type'] == 'sn' && $sv['mvs_id'] == $d['mvs_id'] && $sv['usr_id'] != $this->user['usr_id']){
								
								$d['grp'][] = $this->_prepare_wall_data($sv);
								unset($data[$sk]);
								$i++;
								
							}
							
						}
						
						if(isset($d['grp'])){
							$d['seen_count'] = $i;
							$tree[] = $this->_prepare_wall_data($d);
						}
					
					}else{
						
						$tree[] = $this->_prepare_wall_data($d);
						
					}
					
				}elseif($d['feed_type'] == 'rf'){
					
					foreach($tree as $tk => $tv){
						
						if($tv['feed_id'] == $d['feed_ref_id'])
							$tree[$tk]['ref'][] = $this->_prepare_wall_data($d);
						
					}
					
				}else{
					
					$tree[] = $this->_prepare_wall_data($d);
					
				}
				
			}
			
			return $tree;
			
		}
		
		private function _prepare_wall_data($feed){
			
			$temp = date_parse($feed['feed_time']);
			$feed['feed_year'] = $temp['year'];
			$feed['feed_ago'] = time_calculator($feed['feed_time']);
			$feed['usr_avatar'] = ($feed['usr_avatar'] == '') ? 'images/user.jpg' : $feed['usr_avatar'];
			$feed['owner'] = ($feed['usr_id'] == $this->user['usr_id']) ? 1 : 0;

			if($feed['mvs_poster'] != NULL)				
				$feed['mvs_poster'] = ($feed['mvs_poster'] === '1') ? getCoverPath($feed['mvs_slug'], 'small') : 'images/placeHolder.jpg';
			
			if($feed['list_data_slugs'] !== NULL){
				
				$temp['slugs'] = explode('||', $feed['list_data_slugs']);
				$temp['titles'] = explode('||', $feed['list_data_titles']);
				$temp['poster_fls'] = explode('||', $feed['list_data_posters']);
				
				foreach($temp['slugs'] as $k => $v){
					$feed['cld'][] = array(
						'cover' => ($temp['poster_fls'][$k] === '1') ? getCoverPath($v, 'small') : 'images/placeHolder.jpg',
						'title' => $temp['titles'][$k]
					);
				}
				
			}
			
			unset($temp);
			
			return $feed;
			
		}
		
		public function rate_review($act_id){
			
			if($this->logged_in){
				
				$data = array('usr_id' => $this->user['usr_id'], 'act_id' => $act_id, 'value' => $this->get_vars['val']);
				$this->data['rate_result'] = $this->feed_m->rate_review($data);

			}else{
				
				$this->data['rate_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_rate_item', $this->data);

		}
  
  }

?>