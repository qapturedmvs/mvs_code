<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_Customlist_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('customlist_m');
      
		}
		
		public function index(){ show_404(); }
    
    public function list_lister(){
				
			$json = (object) array();
			$usr = array('usr' => (isset($this->get_vars['usr'])) ? $this->get_vars['usr'] : $this->user['usr_nick'], 'lgn_usr' => ($this->user['usr_id']) ? $this->user['usr_id'] : 0);
			$lists = $this->customlist_m->get_lists($usr);
			$cls = array();
			
			if($lists){
				
				foreach($lists as $k => $v)
				$cls[] = $this->_prepare_list_data($v);

				$json->result = 'OK';
				$json->data = $cls;
				
			}else{
				
				$json->result = 'FALSE';
				$json->data = '';
				
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
				
    }
		
		private function _prepare_list_data($list){
			
			$list['owner'] = ($list['usr_id'] == $this->user['usr_id']) ? 1 : 0;
			$temp['slugs'] = explode('||', $list['list_data_slugs']);
			$temp['titles'] = explode('||', $list['list_data_titles']);
			$temp['poster_fls'] = explode('||', $list['list_data_posters']);
			
			foreach($temp['slugs'] as $k => $v){
				$list['cld'][] = array(
					'cover' => getMoviePoster($temp['poster_fls'][$k], $v, 'small'),
					'title' => $temp['titles'][$k]
				);
			}
			
			unset($temp);
			
			return $list;
			
		}
		
		public function edit_list_detail($list_id = NULL){
				
			if($this->logged_in){
				
				if($list_id){
					
					$vars = $this->input->post(NULL, TRUE);
					
					$data = array('usr_id' => $this->user['usr_id'], 'list_id' => $list_id, 'list_title' => $vars['title'], 'list_order_data' => $vars['order'], 'list_del_data' => (isset($vars['del'])) ? $vars['del'] : '', 'list_order_count' => $vars['oc'], 'list_del_count' => (isset($vars['dc'])) ? $vars['delc'] : 0);

					var_dump($data);
					//$this->data['ecl_result'] = $this->customlist_m->edit_custom_list($data);
					
				}
					
			}else{
				
				$this->data['ecl_result'] = 'no-user';
				
			}
			
			//$this->load->view('results/_cl_edit_list', $this->data);

		}

		public function create_new_list($action){
				
			if($this->logged_in){
				
				$this->load->model('customlist_m');

				$vars = $this->input->post(NULL, TRUE);
				$data = array('usr_id' => $this->user['usr_id'], 'mvs_id' => $vars['id'], 'list_title' => $vars['title'], 'list_slug' => gnrtSlug('list'));
				$this->data['lst_result'] = $this->customlist_m->create_customlist($data);
				
			}else{
				
				$this->data['lst_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_create_new_list', $this->data);
			
		}
		
		public function delete_custom_list($list_id){
				
			if($this->logged_in){
				
				$this->load->model('customlist_m');
				
				$vars = $this->input->post(NULL, TRUE);
				
				if(isset($vars['list'])){
					
					$data = array('list_id' => $list_id, 'usr_id' => $this->user['usr_id']);
					$this->data['lst_result'] = $this->customlist_m->delete_customlist($data);
				
				}else{
					
					show_404();
					
				}
				
			}else{
				
				$this->data['lst_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_cl_delete_custom_list', $this->data);
			
		}
		
		public function rate_customlist($id){
			
			if($this->logged_in){
				
				$data = array('usr_id' => $this->user['usr_id'], 'item_id' => $id, 'value' => $this->get_vars['val'], 'type' => 'cl');
				$this->data['rate_result'] = $this->customlist_m->rate_customlist($data);

			}else{
				
				$this->data['rate_result'] = 'no-user';
				
			}
			
			$this->load->view('results/_rate_item', $this->data);

		}
  
  }

?>