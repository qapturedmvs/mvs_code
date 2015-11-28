<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feed_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();

		}
    
    public function index(){ show_404(); }
    
    public function wall($p = 1){
      
      $this->load->model('feed_m');
      $this->load->model('movie_m');
      
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
      
      $this->load->model('feed_m');
      $this->load->model('movie_m');

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
			
      $this->load->model('feed_m');
      
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
						
						$i = ($d['usr_id'] == $this->user['usr_id']) ? 0 : 1;
						unset($data[$k]);
						
						foreach($data as $sk => $sv){
							
							if($sv['feed_type'] == 'sn' && $sv['mvs_id'] == $d['mvs_id'] && $sv['usr_id'] != $d['usr_id'] && $i < 3){
								
								$d['grp'][] = $this->_prepare_wall_data($sv);
								unset($data[$sk]);
								$i++;
								
							}
							
						}
						
						if(isset($d['grp'])){
							$d['seen_count'] = ($d['usr_seen_fl'] != NULL) ? $i+1 : $i;
							$d['seen_type'] = 'user_group_seen';
							$tree[] = $this->_prepare_wall_data($d);
						}
					
					}else{
						
						$i = 0;
						unset($data[$k]);
						
						foreach($data as $sk => $sv){
							
							if($sv['feed_type'] == 'sn' && $sv['usr_id'] == $d['usr_id'] && (int) $sv['total_seen'] == 1){
								
								$d['grp'][] = $this->_prepare_wall_data($sv);
								unset($data[$sk]);
								$i++;
								
							}
							
						}
						
						if(isset($d['grp']) && $i > 1){
							
							$d['mov_grp_count'] = $i;
							$d['seen_type'] = 'movie_group_seen';
							$tree[] = $this->_prepare_wall_data($d);
							
						}elseif($i == 1){
							
							$d['seen_type'] = 'single_seen';
							$tree[] = $this->_prepare_wall_data($d);
							
							
						}
						
					}
          
        }elseif($d['feed_type'] == 'wt'){
					
					if((int) $d['total_seen'] > 1){
						
						$i = ($d['usr_id'] == $this->user['usr_id']) ? 0 : 1;
						unset($data[$k]);
						
						foreach($data as $sk => $sv){
							
							if($sv['feed_type'] == 'wt' && $sv['mvs_id'] == $d['mvs_id'] && $sv['usr_id'] != $d['usr_id'] && $i < 3){
								
								$d['grp'][] = $this->_prepare_wall_data($sv);
								unset($data[$sk]);
								$i++;
								
							}
							
						}
						
						if(isset($d['grp'])){
							$d['wtc_count'] = ($d['usr_wtc_fl'] != NULL) ? $i+1 : $i;
							$d['wtc_type'] = 'user_group_wtc';
							$tree[] = $this->_prepare_wall_data($d);
						}
					
					}else{
						
						$i = 0;
						unset($data[$k]);
						
						foreach($data as $sk => $sv){
							
							if($sv['feed_type'] == 'wt' && $sv['usr_id'] == $d['usr_id'] && (int) $sv['total_seen'] == 1){
								
								$d['grp'][] = $this->_prepare_wall_data($sv);
								unset($data[$sk]);
								$i++;
								
							}
							
						}
						
						if(isset($d['grp']) && $i > 1){
							
							$d['mov_grp_count'] = $i;
							$d['wtc_type'] = 'movie_group_wtc';
							$tree[] = $this->_prepare_wall_data($d);
							
						}elseif($i == 1){
							
							$d['wtc_type'] = 'single_wtc';
							$tree[] = $this->_prepare_wall_data($d);
							
							
						}
						
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
			$feed['usr_avatar'] = get_user_avatar($feed['usr_avatar']);
			$feed['owner'] = ($feed['usr_id'] == $this->user['usr_id']) ? 1 : 0;

			if(isset($feed['mvs_poster']))	
				$feed['mvs_poster'] = getMoviePoster($feed['mvs_poster'], $feed['mvs_slug'], 'medium');
				
			if(isset($feed['feed_text'])){
				$feed['text_char'] = strlen($feed['feed_text']);
				if($feed['text_char'] > 500){
					
					$feed['text_start'] = substr($feed['feed_text'], 0, 500);
					$feed['text_start'] = substr($feed['text_start'], 0, strrpos($feed['text_start'], ' '));
					$feed['text_end'] = substr($feed['feed_text'], strlen($feed['text_start']), $feed['text_char']);
					
				}
				
			}
      
      if($feed['gnr_id'] != ''){
						
        $feed['genres'] = explode('|', trim($feed['gnr_id'], '|'));
        $temp = $this->cache_table_data('genres', 'movie_m', array('id' => 'gnr_id', 'title' => 'gnr_title'));
        
        foreach($feed['genres'] as $key => $val)
          $feed['genres'][$key] = $temp[$val];
          
      }
			
			if(isset($feed['list_data_slugs'])){
				
				$temp['slugs'] = explode('||', $feed['list_data_slugs']);
				$temp['titles'] = explode('||', $feed['list_data_titles']);
				$temp['poster_fls'] = explode('||', $feed['list_data_posters']);
				
				foreach($temp['slugs'] as $k => $v){
					$feed['cld'][] = array(
						'cover' => getMoviePoster($temp['poster_fls'][$k], $v, 'small'),
						'title' => $temp['titles'][$k]
					);
				}
				
			}
			
			unset($temp);
			
			return $feed;
			
		}
		
		public function rate_review($id){
			
			if($this->logged_in){
				
				$data = array('usr_id' => $this->user['usr_id'], 'item_id' => $id, 'value' => $this->get_vars['val'], 'type' => 'rv');
				$this->data['rate_result'] = $this->feed_m->rate_review($data);

			}else{
				
				$this->data['rate_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_rate_item', $this->data);

		}
  
  }

?>