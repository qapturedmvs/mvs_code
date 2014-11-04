<?php

class Actors_M extends MVS_Model
{
		
	protected $_table_name = 'mvs_stars';
	protected $_primary_key = 'str_id';
	protected $_order_by = 'str_id';
	public $per_page = 100;
	protected $_actor_id = NULL;

	function __construct ()
	{
		parent::__construct();
			
	}
	
	public function actors($offset = 0, $id = NULL){
		
		if($id == NULL)
			$actors = $this->get(NULL,FALSE,$offset);
		else
		{
			$actors = $this->get_by(array('str_id' => $id));
		}
		
		if (count($actors))
			return $actors;
		else
			return FALSE;
	}
	
	public function cast($id)
	{
		/*
		 * bu kod tek seferde cozuyor ancak acayip yavas calisiyor
		 *
		$this->db->select('mvs_cast.char_name, mvs_cast.type_id, mvs_movies.mvs_title');
		$this->db->from('mvs_cast, mvs_movies');
		$this->db->where('mvs_cast.mvs_id = mvs_movies.mvs_id');
		$this->db->where('mvs_cast.str_id = 100');
		
		* yada
		
		$this->db->select('mvs_title');
		$this->db->from('mvs_movies');
		$this->db->join('mvs_cast', 'mvs_cast.mvs_id = mvs_movies.mvs_id');
		$this->db->where('mvs_cast.str_id = 100');
		
		$casting = $this->db->get();
		*/
		
		$movies_arr = NULL;
		$casting_arr = $this->db->get_where('mvs_cast', array('str_id' => $id))->result();
		$cast_type_arr = $this->db->get('mvs_cast_type')->result();
		$ids = array();
		
		if( count($casting_arr) )
		{
			foreach($casting_arr as $c)
				array_push($ids, $c->mvs_id );
					
			$this->db->select('mvs_title, mvs_year, mvs_id');
			$this->db->from('mvs_movies');
			$this->db->where_in('mvs_movies.mvs_id', $ids);
			
			$movies_arr = $this->db->get()->result();
			
			for($i =0;  $i < count($movies_arr); ++$i)
			{
				$movies_arr[$i]->char_name = $casting_arr[$i]->char_name;
				
				foreach($cast_type_arr as $type){
					if($type->type_id == $casting_arr[$i]->type_id)
						$movies_arr[$i]->type_name = $type->type_name;
				}
					
				$movies_arr[$i]->type_id = $casting_arr[$i]->type_id;
			}
		}
		
		if(count($movies_arr))
			return $movies_arr;
		else
			return FALSE;
	}

}