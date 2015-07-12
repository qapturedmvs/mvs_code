<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVS_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	public $rules = array();
	public $per_page = 0;
	
	function __construct() {
		parent::__construct();

		$this->load->driver('cache', $this->config->item('cache_sets'));
		
	}
	
	public function get_data($id = NULL, $offset = 0, $count = FALSE, $filters = NULL, $cache = FALSE){

				$method = 'result';

				if($filters !== NULL || $id !== NULL){

					$this->db->start_cache();
					if($filters !== NULL){
						foreach($filters as $key => $val){
							if(is_array($val)){
								if(is_array($val[0]))
									foreach($val as $subVal)
										call_user_func_array(array(&$this->db, $key), $subVal);
								else
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
					
					//if($cache) $this->db->cache_on(); // File cache for query results
					
					$db_data['data'] = $this->db->get($this->_table_name)->{$method}();
					
					//if($cache) $this->db->cache_off();
					
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
	
	// XSS Filter to a string
	public function cleaner($str){

		return $this->security->xss_clean($str);
	
	}
	
	public function get_userbox($data){
		
		$data['usr_nick'] = $this->cleaner($data['usr_nick']);
		$result = $this->db->call_procedure('sp_get_userbox', $data);
		
		return $result[0];
		
	}
	
}