<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seen_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_seen';
	protected $_primary_key = 'seen_id';
	protected $_order_by = 'seen_time';
	public $per_page = 30;
  
	function __construct (){
		parent::__construct();
	}
  
	
	// Seen list JSON
	public function movies_json($offset = 0, $vars, $defs, $cst_str){
		
		$filters = array(
			'select' => 's.seen_id, m.mvs_id, m.mvs_title, m.mvs_year, m.mvs_runtime, m.mvs_slug, m.mvs_poster, m.gnr_id, m.cntry_id, m.mvs_rating',
			'from' => 'mvs_seen s',
			'join' => array('mvs_movies m', 'm.mvs_id = s.mvs_id', 'inner'),
			'where' => 's.usr_id = '.$cst_str['usr_id'],
			'order_by' => 's.seen_time DESC'
		);

		if(count($vars) > 0){
				$vars = qs_filter($vars, $defs);
				$filters['where'] = (isset($filters['where'])) ? $filters['where'].' AND '.movies_where($vars, $defs) : movies_where($vars, $defs);
		}

		$movies = $this->get_data(NULL, $offset, FALSE, $filters);

		if(count($movies['data']))
			return $movies;
		else
			return FALSE;
	
	}
	
	public function myn_seen_users($data){
		
		$data['mvs'] = $this->cleaner($data['mvs']);

		$users = $this->db->call_procedure('sp_md_myn_seen_users', $data);

		if($users)
			return $users;
		else
			return FALSE;
		
	}
  
}

?>