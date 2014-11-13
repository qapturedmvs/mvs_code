<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Movie extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('movie_m');
		}
		
// 		function _remap($method, $params=array())
// 		{
// 			$methodToCall = method_exists($this, $method) ? $method : 'index';
			
// 			$params = array_slice($this->uri->rsegment_array(), $param_offset);
			
// 			return call_user_func_array(array($this, $methodToCall), $params);
// 		}
		
// 		public function _remap($method)
// 		{	
// 			$param_offset = 3;

// 			if (!method_exists($this, $method))
// 			{
// 				$method = 'index';
// 				$param_offset = 2;
// 			}
			
// 			$params = array_slice($this->uri->rsegment_array(), $param_offset);
			
// 			var_dump($params);
			
// 			//return call_user_func_array(array($this, $method), $params);
			
// 		}
	
		public function index($id = NULL){
			
			//$this->output->cache($this->config->item('mvs_cache_expire'));
			$movie = $this->movie_m->movie($id);

			if($movie){
				$this->data['movie'] = $movie;
				$this->data['casts'] = $this->movie_m->getCastList($movie->mvs_id);
				$gnrId = str_replace('|', ',', $movie->gnr_id);
				$cntId = str_replace('|', ',', $movie->cntry_id);
				$this->data['countries'] = $this->movie_m->_countries('cntry_id IN('.$cntId.')');
				$this->data['genres'] = $this->movie_m->_genres('gnr_id IN('.$gnrId.')');
				
				// Load view
				$this->data['subview'] = 'movie/detail';
				$this->load->view('_main_body_layout', $this->data);
			}else{
				show_404();
			}
			
		}
		
		public function test(){
			echo generateSlug('movie');
		}
		
			
	}

?>