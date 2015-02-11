<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Feeds_Ajx extends Frontend_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('feed_m');
      
		}
    
    public function index(){
      
    }
    
    public function movie_detail($p = 1){
      
			$mvs_id = $this->get_vars['mvs_id'];
			$type = $this->get_vars['type'];
			$usr_id = ($type == 'myn') ? $this->user['usr_id'] : NULL;
			$per_page = 20;
      $json = (object) array();
      $p = $this->feed_m->cleaner($p);
      $offset = ($p-1) * $per_page;
      $db_data = $this->feed_m->movie_feeds_json($mvs_id, $usr_id, $offset);
      $feeds = $db_data['data'];
      
      if($feeds){
        $json->result = 'OK';
        $json->data = $feeds;
      }else{
        $json->result = 'FALSE';
        $json->data = '';
      }

      $data['json'] = json_encode($json);
      $this->load->view('json/movie_feeds_json', $data);
      
    }
  
  }

?>