<?php

class User_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_adm_users';
	protected $_primary_key = 'adm_usr_id';
	protected $_order_by = 'adm_usr_id';
	public $rules = array(
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email|xss_clean'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);
	
	public $rules_admin = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name',
			'rules' => 'trim|required|xss_clean'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm', 
			'label' => 'Confirm password', 
			'rules' => 'trim|matches[password]'
		),
	);

	function __construct ()
	{
		parent::__construct();
	}

	public function login()
	{
		$filters = array('where' => "adm_usr_email = '".$this->input->post('email')."' AND adm_usr_password = '".$this->hash($this->input->post('password'))."'");
		
		$user = $this->get_data(NULL, 0, FALSE, $filters);
		
		if (count($user['data'])) {
			// Log in user
			$data = array(
				'name' => $user['data'][0]->adm_usr_name,
				'email' => $user['data'][0]->adm_usr_email,
				'id' => $user['data'][0]->adm_usr_id,
				'loggedin' => TRUE,
			);
			
			$this->session->set_userdata($data);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
	}

	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function get_new(){
		$user = new stdClass();
		$user->name = '';
		$user->email = '';
		$user->password = '';
		$user->note = '';
		return $user;
	}

	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}