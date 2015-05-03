<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Frontend_Controller extends MVS_Controller
	{
		protected $get_vars = array();
		protected $data = array();
		protected $user = NULL;
		protected $logged_in = FALSE;
		
		// TEMP
		protected $filter_def = array('like' => array('mfc' => array('cntry_id', 'countries', 'cntry_title'), 'mfg' => array('gnr_id', 'genres', 'gnr_title')), 'between' => array('mfr' => 'mvs_rating', 'mfy' => 'mvs_year'), 'network' => array('mfn' => 'network'));
		
		function __construct ()
		{
			parent::__construct();
			
			$this->load->helper(array('form', 'mvs_front_helper'));
			$this->data['site_name'] = $this->config->item('mvs_site_name');

			// CHECK USER LOGGED IN
			$this->logged_in = $this->data['logged_in'] = (bool) $this->session->userdata('usr_loggedin');
			
			if($this->logged_in === TRUE)
				$this->user = $this->data['user'] = $this->session->all_userdata();
			else
				$this->token_check();

		}
		
		protected function session_check(){
				
			if($this->logged_in === FALSE)
				redirect('', 'refresh');
			
		}
		
		protected function token_check(){

			// KEEP ME SIGNED IN CHECK
			if($token = $this->input->cookie('mvs_lgn_token', TRUE)){
				
				$this->load->model('user_m');
				
				$data = array('lgn_email' => NULL, 'lgn_password' => NULL, 'lgn_token' => $token, 'lgn_type' => 'aut', 'lgn_time' => date("Y-m-d H:i:s"));
				$user = $this->user_m->login($data);

				if($user){

					$data = array(
						'usr_id' => $user['usr_id'],
						'usr_nick' => $user['usr_nick'],
						'usr_name' => $user['usr_name'],
						'usr_email' => $user['usr_email'],
						'usr_avatar' => $user['usr_avatar'],
						'usr_loggedin' => TRUE,
					);
						
					$this->session->set_userdata($data);
									
					redirect('user/feeds', 'refresh');
					
				}else{
					
					delete_cookie('mvs_lgn_token');
					
				}
				
			}
			
		}
		
		protected function cache_table_data($table, $model, $fields){
			
			$data = array();

			if(!$data = $this->cache->get($table)){
					$db_data = $this->{$model}->{$table}();
					
					foreach($db_data as $d)
						$data[$d->{$fields['id']}] = $d->{$fields['title']};
					
					$this->cache->save($table, $data, 600);
			}
			
			return $data;
		
		}
		
		protected function users_loop($users){
			
			foreach($users as $user){
				
				if($this->logged_in)
					$user->flw_id = ($user->flw_id === NULL) ? 0 : $user->flw_id;
				
				$user->usr_avatar = ($user->usr_avatar === '') ? 'images/user.jpg' : $user->usr_avatar;
				$user->usr_me = ($user->usr_id === $this->user['usr_id']) ? 1 : 0;
				
			}
			
			return $users;
			
		}
		
	}