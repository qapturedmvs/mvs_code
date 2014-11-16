<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
	
		$settings = $this->get_data($id, $offset);
	
		if (count($settings['data']))
			return $settings;
		else
			return FALSE;
	
	}
	
	// Settings save
	public function save_sets($sets){
		
		$this->db->update_batch('mvs_adm_settings', $sets, 'adm_set_code');
		return TRUE;
		
	}
	
	public function no_slug($table, $key, $slug_key){
		
		return $this->db->select($key)->from($table)->where($slug_key.' IS NULL')->count_all_results();
	
	}
	
	public function set_slug($table, $key, $cols){
		
		$filters = array(
				'select' => $cols,
				'from' => $table,
				'where' => $key.' IS NULL'
		);
		
		$db_data = $this->get_data(NULL, 0, FALSE, $filters);
		$rows = $db_data['data'];
		$res = 0;
		
		foreach($rows as $row){
			
			$type = ($key == 'mvs_slug') ? 'movie' : 'actor';
			$slug = generateSlug($type);
			$check = $this->db->select($key)->from($this->_table_name)->where($key, $slug)->count_all_results();
			
			if($check == 0){

				$this->db->where($cols, $row->{$cols});
				$result = $this->db->update($this->_table_name, array($key => $slug));
			
			}else{
				$res++;
			}

		}
		
		return $res;
		
	}
	
}