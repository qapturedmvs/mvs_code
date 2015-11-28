<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Search_Ajx extends Ajx_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('search_m');
      $this->load->library('elasticsearch');
		}
		
		public function index(){ show_404(); }
		
		public function lister($p = 1){

			$json = (object) array();
			$data = array('keyword' => $this->get_vars['q'], 'type' => 'all', 'ref' => 0, 'offset' => $p, 'per_page' => 10);
			$results = array('all' => array(), 'movie' => array(), 'star' => array());
			
			if(isset($this->get_vars['type']) && $this->get_vars['type'] != 'all'){
				
				$data['type'] = $this->get_vars['type'];
				$data['per_page'] = 50;
	
			}

			$results['all'] = $this->search_m->find_movies_stars($data);
			
			if($results['all']){
				foreach($results['all'] as $k => $v){
					
					if($v['result_type'] == 'movie')
						$v['result_poster'] = getMoviePoster($v['result_poster'], $v['result_slug'], 'small');
					else
						$v['result_poster'] = getStarPhoto($v['result_poster'], $v['result_slug'], 'small');
					
					$results[$v['result_type']][$k] = $v;
					
				}
			}
			
			unset($results['all']);

			if($results){
				
				$json->result = 'OK';
				$json->data = ($data['type'] == 'all') ? $results : $results[$data['type']];
				
			}else{
			
				$json->result = 'FALSE';
				$json->data = '';
			
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
			
		}
		
		public function suggest(){

			$keyword = $this->get_vars['q'];
			
			if($keyword){

				$type = $this->get_vars['t'];
				$json = (object) array('result' => 'FALSE', 'data' => '');
				



				if($type == 'movie' || $type == 'all'){
					
					$results = $this->elasticsearch->advancedquery('', 



					'{


  
								"size":5,
																		"from" : 0,
																	                 "sort": {
																					      "_script": {
																					         "script": "doc[\"mvs_score\"].value + (0.1 * _score)",
																					         "lang": "groovy",
																					         "type": "number",       
																					         "order": "desc"
																					      }
																					   },
					 				
					 					"query": {
	                                                "bool": {
		                                                  "should": [
		                                                  
		                                                    { 
		                                                        
		                                                         "multi_match" : {
		                                                                                "fields" : ["mvs_title"],
		                                                                                  "query" : "'.$keyword.'",
		                                                                                "type" : "phrase_prefix",
		                                                                                "minimum_should_match": "85%"
		                                                                                
		                                                                            }
		                                                        
		                                                    },
		                                                    { 
		                                                        
		                                                        "multi_match" : {
		                                                                                "fields" : ["mvs_title"],
		                                                                                "query" : "'.$keyword.'",
		                                                                              
		                                                                                    "fuzziness": "0.7",
		                                                            							                "boost" : 1.0,
		                                                            							                "prefix_length" : 3,
		                                                            							                "minimum_should_match": "80%"
		                    		
		                                                                                
		                                                                            }
		                                                        
		                                                    }
		                                                  ],
	                                                  "minimum_should_match": 1
	                                                }
	                                              }	



								}
				');
										
										
					if($results['hits']['total'] > 0){
						
						$json->result = 'OK';

						foreach($results['hits']['hits'] as $item)
							$json->data[] = $item;
						
					}
				
				}
				
				if($type == 'star' || $type == 'all'){
					
					$results = $this->elasticsearch->advancedquery('', '{
											"size":5,
											"from" : 0,
											"sort" : [
													{ "str_score" : {"order" : "desc"}}
											],
											"query": {
												"bool": {
													"should": [
															{"match_phrase": {"str_name": "\"'.$keyword.'\""}}
													]
												}
											}
										}');
					
					if($results['hits']['total'] > 0){
						
						$json->result = 'OK';

						foreach($results['hits']['hits'] as $item)
							$json->data[] = $item;
						
					}
				
				}

				$this->data['json'] = json_encode($json);
				$this->load->view('json/main_json_view', $this->data);
				
			}else{
				
				show_404();
				
			}
		}
		
		public function get_users($p = 1){
			
			$data = array('keyword' => $this->get_vars['q'], 'lgn_usr' => ($this->logged_in) ? $this->user['usr_id'] : 0, 'type' => (isset($this->get_vars['type'])) ? $this->get_vars['type'] : 'all', 'offset' => $p, 'per_page' => ($p == 0) ? 5 : 25);
			$results = FALSE;
		 
			if($data['keyword']){
				
				$results = $this->search_m->find_users($data);				
				$results = $this->_users_loop($results);

			}

			$json = (object) array();
	
			if($results){						
				$json->result = 'OK';
				$json->data = $results;
			}else{
				$json->result = 'FALSE';
				$json->data = '';
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
			
		}
		
		public function get_cities(){
			
			$data = array('keyword' => $this->get_vars['q']);
			$results = FALSE;
		 
			if($data['keyword'])
				$results = $this->search_m->get_cities($data);				

			$json = (object) array();
	
			if($results){						
				$json->result = 'OK';
				$json->data = $results;
			}else{
				$json->result = 'FALSE';
				$json->data = '';
			}
			
			$this->data['json'] = json_encode($json);
			$this->load->view('json/main_json_view', $this->data);
			
		}
			
	}

?>