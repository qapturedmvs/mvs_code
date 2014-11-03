<?php
class MVS_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'adm_usr_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	protected $_order_rule = 'ASC';
	protected $_rules = array();
	protected $_per_page = 0;
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
	}
	
	public function get($id = NULL, $single = FALSE, $offset = 0){
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
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
		
		if($this->_per_page !== 0){
			$this->db->limit($this->_per_page, $offset);
		}

		return $this->db->get($this->_table_name)->$method();

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
	
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
	
	public function data_count(){

		return $this->db->count_all_results($this->_table_name);
	
	}
<<<<<<< HEAD
=======
	
	// XSS Filter to a string
	public function cleaner($str){

		return $this->security->xss_clean($str);
	
	}
	
	public function getPaging($curPage, $linkCount){
		
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
					$end = $curPage+$aLinks-(1-$curPage-$bLinks);
				}else{
					$start = $curPage-$bLinks;
					$end = $curPage+$aLinks;
				}
			}else{
				$start = 1;
				$end = $totalPage;
			}
	
			$html = '<li><a class="lastPage" href="'.$this->data['current_url'].'/1">&laquo;</a></li>';
	
			for($i=$start; $i<$end+1; $i++){
					
				if($i == $curPage)
					$html .= '<li class="active"><span>'.$i.'</span></li>';
				else
					$html .= '<li><a href="'.$this->data['current_url'].'/'.$i.'">'.$i.'</a></li>';
	
			}
	
			$html .= '<li><a class="lastPage" href="'.$this->data['current_url'].'/'.$totalPage.'">&raquo;</a></li>';
		}
			
		return $html;
			
	}
	
>>>>>>> parent of 5685b4c... Movie detay
}