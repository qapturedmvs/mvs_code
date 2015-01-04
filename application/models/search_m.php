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
    
    if(count($movies['data']))
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
    
    if(count($stars['data']))
      return $stars;
    else
      return FALSE;
    
  }
  
}

?>