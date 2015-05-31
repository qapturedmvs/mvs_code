<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin_Ajx extends Backend_Controller
	{
		
		function __construct ()
		{
			parent::__construct();
			
			//if(!$this->input->is_ajax_request())
			//	show_404();
			
		}
		
		public function get_movie_cover($p = 1){
			
			$vars = $this->input->get(NULL, TRUE);
			$vars['f'] = (isset($vars['f'])) ? $vars['f'] : 'jpg';
			$vars['s'] = (isset($vars['s'])) ? $vars['s'] : 'huge';
			$start = ($this->security->xss_clean($p) - 1) * 8;
			$url = 'https://ajax.googleapis.com/ajax/services/search/images?v=1.0&as_filetype='.$vars['f'].'&imgc=color&imgsz='.$vars['s'].'&rsz=8&start='.$start.'&q='.urlencode($vars['q']);
			
			$this->data['json'] = file_get_contents($url);
			$this->load->view('json/main_json_view', $this->data);
			
		}

	}
	
?>