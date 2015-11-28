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
	
	// Get login page covers
	public function get_login_covers(){
    
    $covers = $this->db->call_procedure('sp_get_login_covers');

		if($covers)
			return $covers;
		else
			return FALSE;
    
  }
  
  public function login($data){
    
		$data['lgn_password'] = ($data['lgn_password'] != NULL) ? $this->hash($data['lgn_password'], 'sha512') : '';

		$user = $this->db->call_procedure('sp_user_login', $data);

		if($user)
			return $user[0];
		else
			return FALSE;

	}
  
  public function destroy_autologin($usr_id, $token){
		
		$this->db->where("usr_id = $usr_id AND lgn_token = '$token'");
    $this->db->delete('mvs_login');
		
	}
  
  public function user_auth($proc, $data){

    $user = $this->db->call_procedure($proc, $data);

		if($user)
			return $user[0];
		else
			return FALSE;
    
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
  
  public function set_avatar($id, $usr_avatar){
    
    $this->db->where('usr_id', $id);
    $this->db->update('mvs_users', array('usr_avatar' => $usr_avatar));
    
  }
  
  public function set_cover($id, $usr_cover){
    
    $this->db->where('usr_id', $id);
    $this->db->update('mvs_users', array('usr_cover' => $usr_cover));
    
  }
	
	public function reset_password($id, $data){
    
    $password = $this->hash($data['usr_password'], 'sha512');
          
    $this->db->where('usr_id', $id);
		$this->db->set('usr_password', $password);
    $this->db->update('mvs_users');
    
    return TRUE;
  }
    
  public function forget_password($email){
    
    $this->_primary_key = 'usr_email';
    
    $user = $this->get_data($email);
    
    if(isset($user['data']))
      return $user;
    else
      return FALSE;
    
  }
  
  public function check_usr_unique_field($field, $value, $id){
    
    $filters = array(
      'select' => 'usr_id',
      'from' => 'mvs_users',
      'where' => "$field = '$value' AND usr_id != $id"
    );
    
    $user = $this->get_data(NULL, 0, FALSE, $filters);
    
    if(!isset($user['data']))
      return TRUE;
    else
      return FALSE;
    
  }
	
	public function get_user_data($data){
		
    $data['usr_act_key'] = ($data['usr_act_key'] != '') ? $this->cleaner($data['usr_act_key']) : '';
		$user = $this->db->call_procedure('sp_get_user', $data);

		if($user)
			return $user[0];
		else
			return FALSE;
		
	}
	
	public function activate_account($data){
		
    $data['usr_act_key'] = $this->cleaner($data['usr_act_key']);
    $out = array('@result' => NULL);
    $this->db->call_procedure('sp_activate_user', $data, $out);
    $result = $out['@result'];

    return $result;

	}
  
  public function hash($string, $type){
		return hash($type, $string.config_item('encryption_key'));
	}
  
  public function get_user_network($data){
    
    $data['usr_nick'] = $this->cleaner($data['usr_nick']);
    $data['type'] = $this->cleaner($data['type']);
    $data['perpage'] = 100;
    $data['offset'] = ($this->cleaner($data['offset']) - 1) * $data['perpage'];
    
    $users = $this->db->call_procedure('sp_get_user_network', $data);

		if($users)
			return $users;
		else
			return FALSE;
    
  }
  
  public function follow_user($data){
    
    $data['flwd_usr_id'] = $this->cleaner($data['flwd_usr_id']);
    $data['flw_id'] = $this->cleaner($data['flw_id']);
    $out = array('@result' => NULL);
    $this->db->call_procedure('sp_follow', $data, $out);
    $result = $out['@result'];

    return $result;
		
	}

  
}

?>