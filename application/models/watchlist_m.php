<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Watchlist_M extends MVS_Model
{
	
  protected $_table_name = 'mvs_watchlist';
	protected $_primary_key = 'wtc_id';
	protected $_order_by = 'wtc_time';
	public $per_page = 30;
  
	function __construct (){
		parent::__construct();
	}
	
	// Watchlist JSON
	public function movies_json($offset = 0, $vars, $defs, $cst_str){
		
		$filters = array(
			'select' => 'w.wtc_id, m.mvs_id, m.mvs_title, m.mvs_year, m.mvs_runtime, m.mvs_slug, m.mvs_poster, m.gnr_id, m.cntry_id, m.mvs_rating',
			'from' => 'mvs_watchlist w',
			'join' => array(
					array('mvs_movies m', 'm.mvs_id = w.mvs_id', 'inner'),
					array('mvs_seen s', 's.mvs_id = w.mvs_id AND s.usr_id = '.$cst_str['usr_id'], 'left')
			),
			'where' => 'w.usr_id = '.$cst_str['usr_id'],
			'order_by' => 'w.wtc_time DESC'
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
  
}

?>