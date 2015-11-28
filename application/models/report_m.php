<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_M extends MVS_Model
{
  
	function __construct (){
		parent::__construct();
	}
  
 
	
	public function send_feedback($data){
		
    $data['text'] = $this->cleaner($data['text']);
    $data['type'] = $this->cleaner($data['type']);
    $data['subj_id'] = $this->cleaner($data['subj_id']);
    $out = array('@result' => NULL);
    $this->db->call_procedure('sp_user_report', $data, $out);
    $result = $out['@result'];

    return $result;

	}
  //
  //public function report_movie_data($data){
  //  
  //  $data['mvs'] = $this->cleaner($data['mvs']);
  //  $data['text'] = $this->cleaner($data['text']);
  //  $out = array('@result' => NULL);
  //  $this->db->call_procedure('sp_user_report', $data, $out);
  //  $result = $out['@result'];
  //
  //  return $result;
  //  
  //}
  //
  //public function report_star_data($data){
  //  
  //  $data['star'] = $this->cleaner($data['star']);
  //  $data['text'] = $this->cleaner($data['text']);
  //  $out = array('@result' => NULL);
  //  $this->db->call_procedure('sp_user_report', $data, $out);
  //  $result = $out['@result'];
  //
  //  return $result;
  //  
  //}

  
}

?>