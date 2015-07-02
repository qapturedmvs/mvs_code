<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie_Actions_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
      
		}
    
    public function index(){ show_404(); }
    
    public function seen(){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
				if($id = $this->input->post('id', TRUE)){
					
					$data = array('mvs_id' => $id, 'usr_id' => $this->user['usr_id']);
					$this->data['seen_result'] = $this->action_m->seen_movie($data);
					
				}else{
					
					$this->data['seen_result'] = 'no-movie';
					
				}
				
			}else{
				
				$this->data['seen_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_seen_movie', $this->data);

		}
		
		public function mark_all_seen(){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
				$ids = $this->input->post('ids', TRUE);
				$data = array();
				
				foreach($ids as $id)
					$data[] = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $id);
				
				$this->data['seen_result'] = $this->action_m->seen_movie_multi($data);

			}else{
				
				$this->data['seen_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_seen_movie', $this->data);

		}
		
		public function add_remove_watchlist($action){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
				$this->data['action'] = $action;
				$id = $this->input->post('id', TRUE);
				$data = array('action' => $action, 'usr_id' => $this->user['usr_id']);
				
				if($action === 'awtc')
					$data['mvs_id'] = $id;
				else
					$data['wtc_id'] = $id;
					
				$this->data['wtc_result'] = $this->action_m->add_remove_watchlist($data);
					
			}else{
				
				$this->data['wtc_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_wtc_add_remove', $this->data);

		}
		
		public function myn_seen_users($movie = 0){

			if($this->logged_in && $movie != 0){
				
				$this->load->model('seen_m');
				
				$data = array('usr' => $this->user['usr_id'], 'mvs' => $movie, 'offset' => 0, 'limit' => 5);
				$results = $this->seen_m->myn_seen_users($data);
				$json = (object) array();
		
				if($results){

					foreach($results as $k => $result)
						$results[$k]['usr_avatar'] = ($result['usr_avatar'] === '') ? 'images/user.jpg' : $result['usr_avatar'];

					$json->result = 'OK';
					$json->data['total'] = $results[0]['total'];
					$json->data['users'] = $results;
					
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
		
		public function movie_customlists($movie = 0){

			if($this->logged_in && $movie != 0){
				
				$this->load->model('user_custom_list_m');
				
				$data = array('mvs' => $movie, 'usr' => ($this->logged_in) ? $this->user['usr_id'] : NULL, 'type' => 'rlt');
				$results = $this->user_custom_list_m->get_movie_customlists($data);
				$json = (object) array();
		
				if($results){
					
					foreach($results as $key => $result){
						
						if($result['list_data_slugs'] !== NULL){
							
							$temp['slugs'] = explode('||', $result['list_data_slugs']);
							$temp['poster_fls'] = explode('||', $result['list_data_posters']);
							
							foreach($temp['slugs'] as $k => $v)
								$results[$key]['cld'][] = array('cover' => ($temp['poster_fls'][$k] === '1') ? getCoverPath($v, 'small') : 'images/placeHolder.jpg');
							
						}
						
					}

					$json->result = 'OK';
					$json->data['lists'] = $results;
					
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
		
		public function applaud_movie($action){
				
			if($this->logged_in){
				
				$this->load->model('action_m');
				
				$this->data['action'] = $action;
				$id = $this->input->post('id', TRUE);
				$data = array('action' => $action, 'usr_id' => $this->user['usr_id']);
				
				if($action === 'applaud')
					$data['mvs_id'] = $id;
				else
					$data['app_id'] = $id;

				$this->data['applaud_result'] = $this->action_m->applaud_movie($data);
				
			}else{
				
				$this->data['applaud_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_applaud_movie', $this->data);

		}
  
  }

?>