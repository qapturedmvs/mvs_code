<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Avatar extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->session_check();
			$this->output->enable_profiler();
			$this->load->model('user_m');
      
		}
    
    public function index(){

			$this->data['the_user'] = array('avatar' => $this->user['usr_avatar'], 'slug' => $this->user['usr_nick']);
			$this->data['subview'] = 'user/avatar';
			$this->load->view('_main_body_layout', $this->data);
      
    }
		
		function edit(){
			
			$config['upload_path'] = './data/users';
			$config['file_name']  = gnrtString(6, 6).'_'.$this->user['usr_id'].'_temp';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '200';
			$config['max_width']  = '400';
			$config['max_height']  = '400';
			$config['overwrite']  = TRUE;
			
			$this->load->library('upload', $config);
	
			$this->data['image'] = (!$this->upload->do_upload()) ? array('error' => $this->upload->display_errors()) : $this->upload->data();
			$this->data['subview'] = (isset($this->data['image']['error'])) ? 'user/avatar' : 'user/avatar_edit';
			$this->load->view('_main_body_layout', $this->data);
			
		}
		
  
  }

?>