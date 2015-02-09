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
	
		public function index($id = NULL){

			if($this->uri->segment(2) != 'index'){	// Url'den index ile cagirilirsa 404 dönmeli
				
				$actor = $this->actor_m->actor($id);
		
				if($actor){
                    
								$db_data = $this->actor_m->get_chars($actor['data']->str_id);
								$type_unq = array(); 
												
								$this->data['actor'] = $actor['data'];
												
								for($i=0; $i<count($db_data['chars']); $i++){
										
										$db_data['chars'][$i]->mvs_title = $db_data['movies'][$i]->mvs_title;
										$db_data['chars'][$i]->mvs_slug = $db_data['movies'][$i]->mvs_slug;
										$db_data['chars'][$i]->mvs_year = $db_data['movies'][$i]->mvs_year;
										$db_data['chars'][$i]->mvs_rating = $db_data['movies'][$i]->mvs_rating;
										$db_data['chars'][$i]->mvs_imdb_id = $db_data['movies'][$i]->mvs_imdb_id;
										
										foreach($db_data['types'] as $type){
					
												if($db_data['chars'][$i]->type_id == $type->type_id){	
														$db_data['chars'][$i]->type_name = $type->type_name;
												
														if(!in_array($type->type_name, $type_unq))
															array_push($type_unq, $type->type_name);
												}
									
										}
																
								}
								
								function sortByRate($a, $b){
										if ($a->mvs_rating == $b->mvs_rating){
												return 0;
										}
										return ($a->mvs_rating > $b->mvs_rating) ? -1 : 1;
								}
								
								usort($db_data['chars'], "sortByRate");
												
								$this->data['chars'] = $db_data['chars'];
								$this->data['types'] = $type_unq;
								
								// Setting meta_tags object
								$this->data['meta_tags'] = (object) array(
																'title' => $actor['data']->str_name,
																'description' => $actor['data']->str_name,
																'type' => 'actor',
																'image' => $actor['data']->str_photo
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