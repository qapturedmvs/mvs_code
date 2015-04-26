<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_M extends MVS_Model
{
	
	public $per_page = 10;
	
	function __construct ()
	{
		parent::__construct();
	
	}
  
  public function find_movies($keyword, $limited){
    
    $this->per_page = ($limited) ? 10 : 0;
    
    $filters = array(
              'select' => 'mvs_title, mvs_org_title, mvs_slug, mvs_year, mvs_imdb_id',
              'from' => 'mvs_movies',
              'where' => "mvs_title LIKE '%$keyword%' OR mvs_org_title LIKE '%$keyword%'",
              'order_by' => 'mvs_year DESC, mvs_rating DESC'
            );
    
    $movies = $this->get_data(NULL, 0, FALSE, $filters);
    
    if(isset($movies['data']))
      return $movies;
    else
      return FALSE;
    
  }
  
  public function find_stars($keyword, $limited){
    
    $this->per_page = ($limited) ? 10 : 0;
    
    $filters = array(
              'select' => 'str_name, str_slug',
              'from' => 'mvs_stars',
              'where' => "str_name LIKE '%$keyword%'"
            );
    
    $stars = $this->get_data(NULL, 0, FALSE, $filters);
    
    if(isset($stars['data']))
      return $stars;
    else
      return FALSE;
    
  }
  
  public function find_users($data){
    
    $this->per_page = ($data['type'] == 'suggest') ? 10 : 20;
    
    $filters = array(
              'select' => 'u.usr_id, u.usr_name, u.usr_nick, u.usr_avatar',
              'from' => 'mvs_users u',
              'where' => "(u.usr_name LIKE '%".$data['keyword']."%' OR u.usr_nick LIKE '%".$data['keyword']."%') AND u.usr_act = 1"
            );
    
    if($data['login_user']){
      
      $filters['select'] .= ', f.flw_id';
      $filters['join'] = array(
        array('mvs_follows f', 'f.flwd_usr_id = u.usr_id AND f.flwr_usr_id = '.$data['login_user'], 'left')
      );
      $filters['where'] .= ' AND u.usr_id <> '.$data['login_user'];
      
    }
    
    $users = $this->get_data(NULL, 0, FALSE, $filters);
    
    if(isset($users['data']))
      return $users;
    else
      return FALSE;
    
  }

  
}

?>