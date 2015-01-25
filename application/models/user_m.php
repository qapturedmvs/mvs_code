<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_feeds';
	protected $_primary_key = 'act_id';
	protected $_order_by = 'act_time';
	public $per_page = 0;
  
	function __construct (){
		parent::__construct();
	}
  
  //FEEDS JSON
	public function feeds_json($usr_id, $offset = 0){
				
		$filters = array(
				'select' => '*',
        'from' => $this->_table_name,
        'where' => array('usr_id' => $usr_id),
				'order_by' => $this->_order_by.' DESC'
		);
		
		$feeds = $this->get_data(NULL, $offset, FALSE, $filters);
		
		if(count($feeds['data']))
			return $feeds;
		else
			return FALSE;
	
	}
  
  public function login($email, $password)
	{
		$this->per_page = 1;
		$password = $this->hash($password);
		
		$filters = array(
                'select' => '*',
                'from' => 'mvs_users',
                'where' => "usr_email = '$email' AND usr_password = '$password'"
                );
		
		$user = $this->get_data(NULL, 0, FALSE, $filters);

		if (count($user['data'])) {
			// Log in user
			$data = array(
				'usr_name' => $user['data'][0]->usr_name,
				'usr_email' => $user['data'][0]->usr_email,
				'usr_id' => $user['data'][0]->usr_id,
				'usr_loggedin' => TRUE,
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
		return (bool) $this->session->userdata('usr_loggedin');
	}
  
  public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
  
}

?>