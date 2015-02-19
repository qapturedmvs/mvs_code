<?php 
	if($seen_result){
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($seen_result))
			echo '{"result":"OK", "action":"unseen", "msg":"Movie marked as seen", "seen-id":"'.$seen_result.'"}';
			
		elseif($seen_result === 'unseen')
			echo '{"result":"OK", "action":"seen", "msg":"Movie marked as unseen"}';
			
		elseif($seen_result === 'mseen')
			echo '{"result":"OK", "action":"mseen", "msg":"All selected movies marked as seen"}';
		
		elseif($seen_result === 'no-movie')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
		elseif($seen_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
		
	}else{
		
		show_404();
		
	} 

?>