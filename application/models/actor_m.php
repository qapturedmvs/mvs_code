<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actor_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_stars';
	protected $_primary_key = 'str_slug';
	//protected $_order_by = 'str_id';
	public $per_page = 0;
	
	function __construct ()
	{
		parent::__construct();
	
	}
	
	// Actor detail
	public function actor($slug){
		
		$slug = $this->cleaner($slug);
		$filters = array(
			'select' => 'm.mvs_slug, m.mvs_title, m.mvs_year, m.mvs_imdb_rate, m.mvs_rating, m.mvs_poster, c.type_id, ct.type_title, s.str_name',
			'from' => 'mvs_stars s',
			'join' => array(
				array('mvs_cast c', 'c.str_id = s.str_id', 'inner'),
				array('mvs_movies m', 'm.mvs_id = c.mvs_id', 'inner'),
				array('mvs_cast_type ct', 'ct.type_id = c.type_id', 'inner')
			),
			'where' => "s.str_slug = '$slug'",
			'order_by' => 'm.mvs_rating DESC'
		);
		
		$actor = $this->get_data(NULL, 0, FALSE, $filters);

		if (isset($actor['data']))
			return $actor['data'];
		else
			return FALSE;
	
	}
    
}