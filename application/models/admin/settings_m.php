<?php

class Settings_M extends MVS_Model
{


	protected $_table_name = 'mvs_adm_settings';
	protected $_primary_key = 'adm_set_group';
	protected $_order_by = 'adm_set_id';
	protected $_order_rule = 'ASC';
	public $rules = array(
			'mvs_site_name' => array(
					'field' => 'mvs_site_name',
					'label' => 'Site Name',
					'rules' => 'trim|required'
			),
			'mvs_cache_expire' => array(
					'field' => 'mvs_cache_expire',
					'label' => 'Cache Expire',
					'rules' => 'trim|required|numeric'
			)
	);
	public $rules_thumb = array(
			'img_path' => array(
					'field' => 'img_path',
					'label' => 'Path',
					'rules' => 'trim|required'
			),
			'img_width' => array(
					'field' => 'img_width',
					'label' => 'Width',
					'rules' => 'trim|required|numeric'
			),
			'img_height' => array(
					'field' => 'img_height',
					'label' => 'Height',
					'rules' => 'trim|required|numeric'
			)
	);

	function __construct ()
	{
		parent::__construct();

	}
	
	public function settings($id = NULL, $offset = 0){
	
		$settings = $this->get($id, FALSE, $offset);
	
		if (count($settings))
			return $settings;
		else
			return FALSE;
	
	}
	
	// Settings save
	public function save_sets($sets){
		
		$this->db->update_batch('mvs_adm_settings', $sets, 'adm_set_code');
		return TRUE;
		
	}
	
	// Slug check
	public function check_slug($slug){
		
		$this->db->from($this->_table_name);
		$this->db->where($this->_primary_filter, $slug);
		$count = $this->db->count_all_results();
		
		if($count > 0)
			return FALSE;
	
	}
	
}