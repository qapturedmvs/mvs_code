<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_users';
	protected $_primary_key = 'usr_id';
	protected $_order_by = 'usr_id';
	public $per_page = 1;
  
	function __construct (){
		parent::__construct();
	}
  
  public function login($email, $password){
    
		$password = $this->hash($password, 'sha512');
		$this->_primary_key = 'usr_email';
		
		$filters = array(
      'select' => 'usr_id, usr_name, usr_email, usr_act',
      'from' => 'mvs_users',
      'where' => "usr_password = '$password'"
    );
		
		$user = $this->get_data($email, 0, FALSE, $filters);

		if(isset($user['data'])){	
			return $user;
		}else{
			return FALSE;
		}
	}
  
  public function signup($name, $email, $password){
    
		$password = $this->hash($password, 'sha512');
		$usr_act_key = $this->hash($email, 'sha1');
    $user = array(
      'usr_nick' => gnrtSlug('user'),
      'usr_name' => $name,
      'usr_email' => $email,
      'usr_password' => $password,
      'usr_avatar' => '',
      'usr_account' => 'qp',
			'usr_act_key' => $usr_act_key,
      'usr_time' => date('Y-m-d')
    );
		
    $this->db->insert('mvs_users', $user);
    
    return array('usr_id' => $this->db->insert_id(), 'usr_act_key' => $usr_act_key);
	}
  
  public function profile($id){
    
    $user = $this->get_data($id);
    
    if(isset($user['data']))
      return $user;
    else
      return FALSE;
    
  }
  
  public function update_profile($id, $data){
    
    if(isset($data['usr_password']))
      $data['usr_password'] = $this->hash($data['usr_password'], 'sha512');
		
		$data['usr_act_key'] = $this->hash($data['usr_email'], 'sha1');
          
    $this->db->where('usr_id', $id);
    $this->db->update('mvs_users', $data);
    
    return TRUE;
  }
  
  public function check_usr($email, $id){
    
    $filters = array(
      'select' => 'usr_id',
      'from' => 'mvs_users',
      'where' => "usr_email = '$email' AND usr_id != $id"
    );
    
    $user = $this->get_data(NULL, 0, FALSE, $filters);
    
    if(!isset($user['data']))
      return TRUE;
    else
      return FALSE;
    
  }
	
	public function get_user_data($usr, $usr_primary_key){
		
    $this->_primary_key = $usr_primary_key;
		$user = $this->get_data($usr);
		
		if(isset($user['data']))
			return $user;
		else
			return FALSE;
		
	}
	
	public function activate_account($usr_act_key){
		
    $this->db->where('usr_act_key', $usr_act_key);
    $this->db->set('usr_act', 1);
    $this->db->update('mvs_users');
    
    return TRUE;

	}
  
  public function hash($string, $type){
		return hash($type, $string.config_item('encryption_key'));
	}
  
}

?>