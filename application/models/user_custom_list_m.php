<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Custom_List_M extends MVS_Model
{
	
	protected $_table_name = 'mvs_custom_lists';
	protected $_primary_key = 'list_id';
	protected $_order_by = 'list_time';
	public $per_page = 30;
  
	function __construct (){
		parent::__construct();
	}
  
	// User Custom Lists (User Movie Lists)
	public function get_lists($usr_id){
		
		$filters = array(
			'where' => 'usr_id = '.$usr_id,
			'order_by' => 'list_time DESC'
		);
		
		$lists = $this->get_data(NULL, 0, TRUE, $filters);
		
		if(isset($lists['data']))
			return $lists;
		else
			return FALSE;
		
	}
	
	public function get_customlist_detail($data){

		$cl = $this->db->call_procedure('sp_get_customlist', $data);

		if($cl)
			return $cl;
		else
			return FALSE;
		
	}
	
	// Custom Movie list JSON
	public function movies_json($offset = 0, $vars, $defs, $cst_str){
		
		$filters = array(
			'select' => 'c.ldt_id, m.mvs_id, m.mvs_title, m.mvs_year, m.mvs_runtime, m.mvs_slug, m.mvs_poster, m.gnr_id, m.cntry_id, m.mvs_rating, m.mvs_plot',
			'from' => 'mvs_custom_list_data c',
			'join' => array(
				array('mvs_custom_lists cl', 'cl.list_id = c.list_id', 'inner'),
				array('mvs_movies m', 'm.mvs_id = c.mvs_id', 'inner')
			),
			'where' => 'c.list_id = '.$cst_str['list_id'],
			'order_by' => 'c.ldt_list_order ASC, c.ldt_id DESC'
		);
		
		if($cst_str['usr_id'] !== NULL){
			$filters['select'] .= ', s.seen_id';
			$filters['join'][] = array('mvs_seen s', 's.mvs_id = c.mvs_id AND s.usr_id = '.$cst_str['usr_id'], 'left');
		}
		
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
	
	public function create_customlist($data){

		$out = array('@list_id' => NULL, '@ldt_id' => NULL);
		$this->db->call_procedure('sp_new_customlist', $data, $out);
		$result = array('list_id' => $out['@list_id'], 'ldt_id' => $out['@ldt_id']);

		return $result;
		
	}
	
		public function delete_customlist($data){
		
		$out = array('@result' => NULL);
		$this->db->call_procedure('sp_delete_customlist', $data, $out);
		$result = $out['@result'];

		return $result;
		
	}
	
	public function add_remove_from_list($data){
		
		if($data['action'] === 'atcl'){
			
			unset($data['action']);
			$out = array('@ldt_id' => NULL);
			$this->db->call_procedure('sp_addto_customlist', $data, $out);
			$result = $out['@ldt_id'];

		}else{
			
			$this->db->where('ldt_id = '.$data['ldt_id'].' AND mvs_id = '.$data['mvs_id']);
			$this->db->delete('mvs_custom_list_data');
			$result = 'rfcl';
			
		}
		
		return $result;
		
	}
	
	// Movie Detail Custom Lists
	public function get_custom_lists($data){
		
		$filters = array(
			'select' => 'cl.list_id, cl.list_title, cld.ldt_id',
			'from' => 'mvs_custom_lists cl',
			'join' => array('mvs_custom_list_data cld', 'cld.list_id = cl.list_id AND cld.mvs_id = '.$data['mvs_id'], 'left'),
			'where' => 'cl.usr_id = '.$data['usr_id'],
			'order_by' => 'cl.list_time DESC'
		);
		
		$cl = $this->get_data(NULL, 0, FALSE, $filters);
		
		if(isset($cl['data']))
			return $cl['data'];
		else
			return FALSE;
		
	}
	
	public function edit_custom_list($data){
		
		$this->db->update('mvs_custom_lists', array('list_title' => $data['list_title']), 'list_id = '.$data['list_id'].' AND usr_id = '.$data['usr_id']);
		return TRUE;
	
	}
	
	public function multi_remove_from_list($data){
		
		$data = $this->cleaner($data);
		$sql = 'DELETE cl
						FROM mvs_custom_list_data cl
						INNER JOIN mvs_custom_lists c ON c.list_id = cl.list_id AND usr_id = '.$data['usr_id'].
						' WHERE cl.ldt_id IN('.$data['ldt_id'].')';
		
		$this->db->query($sql);
		
		return TRUE;
		
	}
	
	public function rate_customlist($data){
			
			$data['list_id'] = $this->cleaner($data['list_id']);
			$out = array('@result' => NULL);
			$this->db->call_procedure('sp_rate_customlist', $data, $out);
			$result = $out['@result'];
		
		return $result;
	
	}
	
  
}

?>