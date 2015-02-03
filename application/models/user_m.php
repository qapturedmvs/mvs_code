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
    
		$password = $this->hash($password);
		
		$filters = array(
                'select' => 'usr_id, usr_name, usr_email',
                'from' => 'mvs_users',
                'where' => "usr_email = '$email' AND usr_password = '$password'"
                );
		
		$user = $this->get_data(NULL, 0, FALSE, $filters);

		if(count($user['data'])){

			$data = array(
				'usr_name' => $user['data'][0]->usr_name,
				'usr_email' => $user['data'][0]->usr_email,
				'usr_id' => $user['data'][0]->usr_id,
				'usr_loggedin' => TRUE,
			);

			$this->session->set_userdata($data);
			
			return TRUE;
		}else{
			return FALSE;
		}
	}
  
  public function signup($name, $email, $password){
    
		$password = $this->hash($password);
		$usr_act_key = $this->hash($email); 
    $user = array(
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
    
    if(count($user['data']))
      return $user;
    else
      return FALSE;
    
  }
  
  public function update_profile($id, $data){
    
    if(isset($data['usr_password']))
      $data['usr_password'] = $this->hash($data['usr_password']);
		
		$data['usr_act_key'] = $this->hash($data['usr_email']);
          
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
    
    if(count($user['data']) === 0)
      return TRUE;
    else
      return FALSE;
    
  }
	
	public function get_usr_act_key($usr_id){
		
		$user = $this->get_data($usr_id);
		
		if(count($user['data']))
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
  
  public function hash($string){
		return hash('sha512', $string . config_item('encryption_key'));
	}
  
}

?>