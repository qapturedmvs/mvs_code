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
      'select' => '*',
      'from' => 'mvs_users',
      'where' => "usr_password = '$password'"
    );
		
		$user = $this->get_data($email, 0, FALSE, $filters);

		if(isset($user['data'])){

      $this->db->where('usr_id', $user['data']->usr_id);
      $this->db->set('usr_last_login', date($this->_timestamp));
      $this->db->update('mvs_users');
			
			return $user;
    
		}else{
      
			return FALSE;
    
		}
	}
  
  public function signup($data){
    
		$password = $this->hash($data['sgn_password'], 'sha512');
		$usr_act_key = $this->hash($data['sgn_email'], 'sha1');
    $user = array(
      'usr_nick' => gnrtSlug('user'),
      'usr_name' => $data['sgn_name'],
      'usr_email' => $data['sgn_email'],
      'usr_password' => $password,
      'usr_avatar' => '',
			'usr_slogan' => '',
      'usr_account' => 'qp',
			'usr_act_key' => $usr_act_key,
      'usr_time' => date($this->_timestamp)
    );
		
    $this->db->insert('mvs_users', $user);
    
    return array('usr_id' => $this->db->insert_id(), 'usr_name' => $data['sgn_name'], 'usr_act_key' => $usr_act_key);
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
  
  public function get_user_network($data){
    
    $this->per_page = 30;
    
    $p = $this->cleaner($data['p']);
    $curPage = ($p != '') ? $p : 1;
    $offset = ($curPage-1) * $this->per_page;
    
    if($data['action'] === 'followers'){
      
      $filters = array(
        'select' => 'us.usr_id, us.usr_nick, us.usr_name, us.usr_avatar',
        'from' => 'mvs_users u',
        'join' => array(
          array('mvs_follows f', 'f.flwd_usr_id = u.usr_id', 'inner'),
          array('mvs_users us', 'us.usr_id = f.flwr_usr_id', 'inner')
        ),
        'where' => "u.usr_nick = '".$data['nick']."'",
        'order_by' => 'us.usr_name ASC'
      );
      
      if(isset($data['login_user'])){
        $filters['select'] .= ', fl.flw_id';
        //$filters['join'][0][1] .= ' AND f.flwr_usr_id != '.$data['login_user'];
        $filters['join'][] = array('mvs_follows fl', 'fl.flwd_usr_id = f.flwr_usr_id AND fl.flwr_usr_id = '.$data['login_user'], 'left');
      }
      
    }else{
      
      $filters = array(
        'select' => 'us.usr_id, us.usr_nick, us.usr_name, us.usr_avatar',
        'from' => 'mvs_users u',
        'join' => array(
          array('mvs_follows f', 'f.flwr_usr_id = u.usr_id', 'inner'),
          array('mvs_users us', 'us.usr_id = f.flwd_usr_id', 'inner')
        ),
        'where' => "u.usr_nick = '".$data['nick']."'",
        'order_by' => 'us.usr_name ASC'
      );
      
      if(isset($data['login_user'])){
        $filters['select'] .= ', fl.flw_id';
        //$filters['join'][0][1] .= ' AND f.flwd_usr_id != '.$data['login_user'];
        $filters['join'][] = array('mvs_follows fl', 'fl.flwd_usr_id = f.flwd_usr_id AND fl.flwr_usr_id = '.$data['login_user'], 'left');
      }
      
    }
    
    $network = $this->get_data(NULL, $offset, TRUE, $filters);

    if(isset($network['data']))
      return $network;
    else
      return FALSE;
    
  }
  
}

?>