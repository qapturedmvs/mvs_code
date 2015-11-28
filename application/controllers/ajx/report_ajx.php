<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Report_Ajx extends Ajx_Controller{
    
		function __construct(){
			parent::__construct();
			
			$this->load->model('report_m');
      
		}
    
    public function send_feedback(){
      
      $vars = $this->input->post(NULL, TRUE);
      $this->data['result'] = 0;
      
      if($vars && $this->logged_in){
        
        $data = array('usr' => $this->user['usr_id'], 'type' => $vars['type'], 'subj_id' => $vars['id'], 'text' => $vars['t']);
        $this->data['result'] = $this->report_m->send_feedback($data);
        
      }
      
      $this->load->view('results/report/_main_report_result', $this->data);
      
    }
		
    //public function report_movie($type == NULL){
    //  
    //  $vars = $this->input->post(NULL, TRUE);
    //  $this->data['result'] = 0;
    //  
    //  if(isset($vars['id']) && $this->logged_in && $type){
    //    
    //    $data = array('usr' => $this->user['usr_id'], 'mvs' => $vars['id'], 'text' => (isset($vars['t'])) ? $vars['t'] : '');
    //    $this->data['result'] = $this->report_m->report_movie_data($data);
    //    
    //  }
    //  
    //  $this->load->view('results/report/_main_report_result', $this->data);
    //  
    //}
    //
    //public function report_star($type == NULL){
    //  
    //  $vars = $this->input->post(NULL, TRUE);
    //  $this->data['result'] = 0;
    //  
    //  if(isset($vars['id']) && $this->logged_in && $type){
    //    
    //    $data = array('usr' => $this->user['usr_id'], 'star' => $vars['id'], 'text' => (isset($vars['t'])) ? $vars['t'] : '');
    //    $this->data['result'] = $this->report_m->report_actor_data($data);
    //    
    //  }
    //  
    //  $this->load->view('results/report/_main_report_result', $this->data);
    //  
    //}
  
  }

?>