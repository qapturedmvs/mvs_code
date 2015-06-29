<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Actor extends Frontend_Controller{
		function __construct(){
			parent::__construct();
			
			$this->output->enable_profiler();
			$this->load->model('actor_m');
		}

		public function _remap($method,$args){
		
			if (method_exists($this, $method))
				$this->$method($args);
			else
				$this->index($method,$args);
			
		}
	
		public function index($slug = NULL){

			if($this->uri->segment(2) !== 'index'){	// Url'den index ile cagirilirsa 404 dönmeli
				
				$actor = $this->actor_m->actor($slug);
		
				if($actor){
          
					$featured = array();
					$movies = array();
					$i = 0;

					foreach($actor as $key => $val){
						
						if($i === 0)
							$this->data['actor'] = $actor[$key]->str_name;
						
						if($i < 5 && $actor[$key]->mvs_poster != 0){

							$featured[$actor[$key]->mvs_slug] = array('poster' => $actor[$key]->mvs_poster, 'title' => $actor[$key]->mvs_title, 'year' => $actor[$key]->mvs_year, 'slug' => $actor[$key]->mvs_slug);
							$i++;

						}
						
						$movies[$actor[$key]->type_title][$actor[$key]->mvs_year][] = array('title' => $actor[$key]->mvs_title, 'slug' => $actor[$key]->mvs_slug);

					}
					
					ksort($movies);
					
					foreach($movies as $key => $val)
						krsort($movies[$key]);
					
					unset($actor);
					
					$this->data['featured'] = $featured;
					$this->data['movies'] = $movies;
					
					 //Setting meta_tags object
					$this->data['meta_tags'] = (object) array(
						'title' => $this->data['actor'],
						'description' => $this->data['actor'],
						'type' => 'actor',
						'image' => ''
					);
					
					// Load view
					$this->data['subview'] = 'actor/detail';
					$this->load->view('_main_body_layout', $this->data);
					
				}else{
					show_404();
				}
			
			}else{
				show_404();
			}
			
		}		
			
	}

?>