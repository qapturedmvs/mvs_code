<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ajx_Controller extends Frontend_Controller
	{
		
		function __construct ()
		{
			parent::__construct();
			
			//if(!$this->input->is_ajax_request())
			//	show_404();
			
		}
		
		protected function _users_loop($users){
			
			foreach($users as $key => $user){
				
				if($this->logged_in){
					$users[$key]['lgn_flwr'] = ($user['lgn_flwr'] === NULL) ? 0 : $user['lgn_flwr'];
					$users[$key]['lgn_flwd'] = ($user['lgn_flwd'] === NULL) ? 0 : $user['lgn_flwd'];
				}
				
				$users[$key]['usr_avatar'] = get_user_avatar($user['usr_avatar']);
				$users[$key]['usr_me'] = ($user['usr_id'] === $this->user['usr_id']) ? 1 : 0;
				
			}
			
			return $users;
			
		}

	}