<?php
class MVS_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	protected $_order_rule = 'ASC';
	public $rules = array();
	public $per_page = 0;
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
	}
	
	public function get_data($id = NULL, $offset = 0, $filters = array()){
	
		$this->db->start_cache();
	
		foreach($filters as $key => $val)
			//echo $key.'-->'.$val;
			$this->db->{$key}($val);
// 		$this->db->select('*');
// 		$this->db->from('mvs_stars');
// 		$this->db->like('str_name', "'%marlon%'");
	
		$this->db->stop_cache();
	
		//$db_data['total_count'] = $this->db->count_all_results($this->_table_name);
	
		$method = ($id != NULL) ? 'row' : 'result';
	
		if($this->per_page !== 0)
			$this->db->limit($this->per_page, $offset);
	
		$db_data['data'] = $this->db->get($this->_table_name)->{$method}();
	
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
	
	public function get($id = NULL, $single = FALSE, $offset = 0, $select = NULL){
		
		if($select != NULL){
			$this->db->select($select);
			//$this->db->from($this->_table_name);
		}
		
		if ($id != NULL) {
			if($this->_primary_filter != NULL){
				$filter = $this->_primary_filter;
				$id = $filter($id);
			}
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by, $this->_order_rule);
		}
		
		if($this->per_page !== 0){
			$this->db->limit($this->per_page, $offset);
		}

		return $this->db->get($this->_table_name)->$method();

	}
	
	public function get_with($cols = '*', $where = NULL){
		
		$this->db->select($cols);
		$this->db->from($this->_table_name);
		if($where != NULL) $this->db->where($where);
		return $this->db->get()->result();
		
	}
	
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}
	
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
	
	// Get count of all data in a table
	public function data_count($table){

		return $this->db->count_all_results($table);
	
	}
	
	// XSS Filter to a string
	public function cleaner($str){

		return $this->security->xss_clean($str);
	
	}
	
	public function getPaging($curPage, $linkCount, $path){
		
		$total = $this->data_count($this->_table_name);
		$totalPage = ceil($total/$this->per_page);
		$aLinks = floor(($linkCount-1)/2);
		$bLinks = $linkCount-$aLinks-1;
		$html = '';
			
		if($totalPage > 1){
			if($totalPage > $linkCount){
				if($curPage+$aLinks > $totalPage){
					$end = $totalPage;
					$start = $curPage-$bLinks+($curPage+$aLinks-$totalPage);
				}else if($curPage-$bLinks < 1){
					$start = 1;
					$end = $curPage+$aLinks-($curPage-$bLinks-1);
				}else{
					$start = $curPage-$bLinks;
					$end = $curPage+$aLinks;
				}
			}else{
				$start = 1;
				$end = $totalPage;
			}
	
			$html = '<li><a class="lastPage" href="'.$this->data['site_url'].$path.'/1">&laquo;</a></li>';
	
			for($i=$start; $i<$end+1; $i++){
					
				if($i == $curPage)
					$html .= '<li class="active"><span>'.$i.'</span></li>';
				else
					$html .= '<li><a href="'.$this->data['site_url'].$path.'/'.$i.'">'.$i.'</a></li>';
	
			}
	
			$html .= '<li><a class="lastPage" href="'.$this->data['site_url'].$path.'/'.$totalPage.'">&raquo;</a></li>';
		}
			
		return $html;
			
	}
	
}