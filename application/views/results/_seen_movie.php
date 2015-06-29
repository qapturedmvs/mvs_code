<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($seen_result == -1)
			echo '{"result":"OK", "action":"seen", "msg":"Movie marked as unseen"}';
		
		elseif($seen_result == 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
			
		elseif($seen_result == 'no-movie')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
		
		else
			echo '{"result":"OK", "action":"unseen", "msg":"Movie marked as seen", "seen-id":"'.$seen_result.'"}';

?>