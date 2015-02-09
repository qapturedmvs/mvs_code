<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVS_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	//protected $_primary_filter = 'intval';
	//protected $_order_by = '';
	//protected $_order_rule = 'ASC';
	public $rules = array();
	public $per_page = 0;
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();

		$this->load->driver('cache', $this->config->item('cache_sets'));
		
	}
	
	public function get_data($id = NULL, $offset = 0, $count = FALSE, $filters = NULL, $cache = FALSE){

				$chk_filters = is_array($filters);
				$method = 'result';
				
				if($chk_filters || $id !== NULL){
					
					$this->db->start_cache();
					
					if($chk_filters){
						foreach($filters as $key => $val){
							if(is_array($val) && count($val) > 1){
								call_user_func_array(array(&$this->db, $key), $val);
							}else{
								if($key === 'from')
									$this->_table_name = $val;
								elseif($key === 'method')
									$method = $val;
								else
									$this->db->{$key}($val);
							}
						}
					}
						
					if($id !== NULL){
						$this->db->where($this->_primary_key, $id);
						$this->per_page = 1;
						$method = 'row';
					}
				
					$this->db->stop_cache();
					
				}

				$db_data['total_count'] = (!$count) ? FALSE : $this->db->count_all_results($this->_table_name);
				
				if($count !== 'ONLY'){
								
					if($this->per_page !== 0)
						$this->db->limit($this->per_page, $offset);
					
					if($cache) $this->db->cache_on(); // File cache for query results
					
					$db_data['data'] = $this->db->get($this->_table_name)->{$method}();
					
					if($cache) $this->db->cache_off();
					
					if(count($db_data['data']) === 0)
						unset($db_data['data']);
								
				}
				
				$this->db->flush_cache();
				
				return $db_data;
	
	}
	
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}
	
	// Save
	public function save($data, $id = NULL){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		
		return $id;
	}
	
	// Delete
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if(!$id)
			return FALSE;
		
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
	
	// XSS Filter to a string
	public function cleaner($str){

		return $this->security->xss_clean($str);
	
	}
	
}