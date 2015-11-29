<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Actions_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
      
		}
    
    public function index(){ show_404(); }
    
    public function s_seen(){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				$vars = $this->input->post(NULL, TRUE);
				
				if($vars){
					
					$data = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['id'], 'seen_id' => $vars['itm']);
					$this->data['result'] = $this->action_m->seen_movie($data);
					
				}else{
					
					$this->data['result'] = 'no-movie';
					
				}
				
			}else{
				
				$this->data['result'] = 'no-user';
				
			}
			
			$this->load->view('results/_seen_movie', $this->data);

		}
		
		public function s_watchlist(){
				
			if($this->logged_in){
				
				$this->load->model('action_m');

				$vars = $this->input->post(NULL, TRUE);
				
				if($vars){
					
					$data = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['id'], 'wtc_id' => $vars['itm']);
					$this->data['result'] = $this->action_m->add_remove_watchlist($data);
				
				}else{
					
					$this->data['result'] = 'no-movie';
					
				}
					
			}else{
				
				$this->data['result'] = 'no-user';
				
			}
			
			$this->load->view('results/_wtc_add_remove', $this->data);

		}
		
		public function s_applaud(){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
				$vars = $this->input->post(NULL, TRUE);
				
				if($vars){
					
					$data = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['id'], 'app_id' => $vars['itm']);
					$this->data['result'] = $this->action_m->applaud_movie($data);
				
				}else{
					
					$this->data['result'] = 'no-movie';
					
				}
				
			}else{
				
				$this->data['result'] = 'no-user';
				
			}
			
			$this->load->view('results/_applaud_movie', $this->data);

		}
		
		public function s_customlist($list = NULL){
			
			if($this->logged_in && $list){
				
				$this->load->model('action_m');
				
				$vars = $this->input->post(NULL, TRUE);
				
				if($vars){
					
					$data = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['id'], 'list_id' => $list);
					$this->data['result'] = $this->action_m->add_remove_from_customlist($data);
				
				}else{
					
					$this->data['result'] = 'no-movie';
					
				}
				
			}else{
				
				$this->data['result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_add_remove_from_list', $this->data);

		}
		
		// Movie list bulk actions $act = (seen, wtc)
		public function bulk_action($act = NULL){
				
			if($this->logged_in && $act){
				
				$this->load->model('action_m');
				
				$this->data['action'] = $act;
				$vars = $this->input->post(NULL, TRUE);
				$data = array('usr_id' => $this->user['usr_id'], 'mvs' => $vars['ids'],'mvs_c' => $vars['mc']);
				
				$this->data['result'] = $this->action_m->bulk_action($data, $act);

			}else{
				
				$this->data['result'] = 'no-user';
				
			}
			
			$this->load->view('results/_bulk_action', $this->data);

		}
		
		
		// Movie detail seen users in my network
		public function md_myn_sn_usrs($movie = NULL){

			if($this->logged_in && $movie){
				
				$this->load->model('action_m');
				
				$data = array('usr' => $this->user['usr_id'], 'mvs' => $movie, 'offset' => 0, 'limit' => 5);
				$results = $this->action_m->get_md_myn_seen_users($data);
				$json = (object) array();
		
				if($results){

					foreach($results as $k => $result)
						$results[$k]['usr_avatar'] = ($result['usr_avatar'] === '') ? 'images/user.jpg' : '/data/users/'.$result['usr_avatar'].'.jpg';

					$json->result = 'OK';
					$json->data['total'] = $results[0]['total'];
					$json->data['users'] = $results;
					
				}else{
					
					$json->result = 'FALSE';
					$json->data = '';
				
				}
				
				
			
			}else{
				
				$json->result = 'FALSE';
				$json->data = '';
				
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);

		}
		
		// Movie detail related customlists
		public function md_rlt_cls($movie = NULL){

			if($movie){
				
				$this->load->model('customlist_m');
				
				$data = array('mvs' => $movie, 'usr' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'type' => 'rlt');
				$results = $this->customlist_m->get_movie_customlists($data);
				$json = (object) array();
		
				if($results){
					
					foreach($results as $key => $result){
						
						if($result['list_data_slugs'] !== NULL){
							
							$temp['slugs'] = explode('||', $result['list_data_slugs']);
							$temp['poster_fls'] = explode('||', $result['list_data_posters']);
							
							foreach($temp['slugs'] as $k => $v)
								$results[$key]['cld'][] = array('cover' => getMoviePoster($temp['poster_fls'][$k], $v, 'small'));
							
						}
						
					}

					$json->result = 'OK';
					$json->data['lists'] = $results;
					
				}else{
					
					$json->result = 'FALSE';
					$json->data = '';
				
				}
			
			}else{
				
				$json->result = 'FALSE';
				$json->data = '';
				
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);

		}
		
		// Get users add to list menu
		public function get_add_cls_menu($movie = NULL){
			
			$this->data['results'] = '';
			
			if($movie){
				
				$this->load->model('customlist_m');
				
				$data = array('mvs' => $movie, 'usr' => ($this->logged_in) ? $this->user['usr_id'] : 0);
				$this->data['results'] = $this->customlist_m->get_add_cls_menu($data);
				
			}
			
			$this->load->view('html_results/_add_cls_menu', $this->data);

		}
  
  }

?>