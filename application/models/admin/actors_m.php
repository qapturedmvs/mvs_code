<?php

class Actors_M extends MVS_Model
{
	
		
	protected $_table_name = 'mvs_stars';
	protected $_primary_key = 'str_id';
	protected $_order_by = 'str_id';
	protected $_order_rule = 'ASC';
	protected $_per_page = 100;
	protected $_actor_id = NULL;

	function __construct ()
	{
		parent::__construct();
			
		if(isset($_GET['id']))
			$this->_actor_id = $_GET['id'];
	}
	
	public function actors($offset = 0){
		
		if($this->_actor_id == NULL)
			$actors = $this->get(NULL,FALSE,$offset);
		else
		{
			$actors = $this->get_by(array('str_id' => $this->_actor_id));
		}
		
		if (count($actors))
			return $actors;
		else
			return "No data found...";
	}
	
	public function cast()
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
		
		$casting = $this->db->get_where('mvs_cast', array('str_id' => $this->_actor_id));
		
		$casting_arr = $casting->result();
		
		$ids = array();
		
		if( count($casting_arr) )
		{
			foreach($casting_arr as $c)
				array_push($ids, $c->mvs_id );
				
			
			$this->db->select('mvs_title, mvs_year');
			$this->db->from('mvs_movies');
			$this->db->where_in('mvs_movies.mvs_id', $ids);
			
			$movies = $this->db->get();
			
			$movies_arr = $movies->result();
			
			
			for($i =0;  $i < count($movies->result()); ++$i)
			{
				$movies_arr[$i]->char_name = $casting_arr[$i]->char_name;
				$movies_arr[$i]->type_id = $casting_arr[$i]->type_id;
			}
		}
		
		
		
		if(count($movies_arr))
			return $movies_arr;
		else
			return "No casting data found...";
	}

}