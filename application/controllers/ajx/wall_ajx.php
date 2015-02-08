<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Wall_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			//$this->output->enable_profiler();
			$this->load->model('feed_m');
      
		}
    
    public function index(){
      
    }
    
    public function lister($p = 1){
      
      $json = (object) array();
      $p = $this->user_m->cleaner($p);
      $offset = ($p-1) * $this->feed_m->per_page;
      $db_data = $this->feed_m->feeds_json($this->user['usr_id'], $offset);
      $feeds = $db_data['data'];
      
      if($feeds){
        $json->result = 'OK';
        $json->data = $feeds;
      }else{
        $json->result = 'FALSE';
        $json->data = '';
      }

      $data['json'] = json_encode($json);
      $this->load->view('json/feeds_json', $data);
      
    }
  
  }

?>