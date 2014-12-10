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
	public function actor($id){
		
		$id = $this->cleaner($id);
		$actor = $this->get_data($id, 0, FALSE, NULL);
	
		if (count($actor['data']) == 1)
			return $actor;
		else
			return FALSE;
	
	}
    
    public function get_chars($id){
        
			$filters = array(
					'select' => 'mvs_id, type_id, char_name',
					'from' => 'mvs_cast',
					'where' => 'str_id = '.$id,
					'order_by' => array('mvs_id', 'ASC')
			);
			$chars = $this->get_data(NULL, 0, FALSE, $filters);
			$temp = '';
									
			foreach($chars['data'] as $char)
					$temp .= $char->mvs_id.',';
					
			$filters = array(
					'select' => 'mvs_id, mvs_slug, mvs_title, mvs_year, mvs_rating, mvs_imdb_id',
					'from' => 'mvs_movies',
					'where' => 'mvs_id IN('.trim($temp, ',').')',
					'order_by' => array('mvs_id', 'ASC')
			);
			
			$movies = $this->get_data(NULL, 0, FALSE, $filters);
			$this->_table_name = 'mvs_cast_type';
			$cast_types = $this->get_data();
			$db_data['chars'] = $chars['data'];
			$db_data['movies'] = $movies['data'];
			$db_data['types'] = $cast_types['data'];
			
			if (count($db_data))
				return $db_data;
			else
				return FALSE;
		
    }
}