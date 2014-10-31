<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Backend_Controller extends MVS_Controller
	{
	
		function __construct ()
		{
			parent::__construct();
			
			// Default Variables
			$this->data['site_name'] = "Qaptured";
			$this->data['site_url'] = site_url();
			$this->data['current_url'] = current_url();
			
			$this->load->helper(array('form', 'mvs_helper'));
			$this->load->library('form_validation');
			$this->load->model('admin/user_m');
			
			// Login check
			$exception_uris = array('admin/user/login', 'admin/user/logout');
			
			if (in_array(uri_string(), $exception_uris) == FALSE) {
				if ($this->user_m->loggedin() == FALSE) {
					redirect('admin/user/login');
				}
			}

		}
		
		public function _getPaging($total, $perPage, $curPage, $linkCount){
			
			$totalPage = ceil($total/$perPage);
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
				
				$html = '<li><a class="lastPage" href="'.$this->data['current_url'].'1">&laquo;</a></li>';
				
				for($i=$start; $i<$end+1; $i++){
					
					if($i == $curPage)
						$html .= '<li class="active"><span>'.$i.'</span></li>';
					else
						$html .= '<li><a href="'.$this->data['current_url'].$i.'">'.$i.'</a></li>';
						
				}
				
				$html .= '<li><a class="lastPage" href="'.$this->data['current_url'].$totalPage.'">&raquo;</a></li>';
			}
			
			return $html;
			
		}
	}