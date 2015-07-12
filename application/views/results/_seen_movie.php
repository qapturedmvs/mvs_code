<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($result == -1)
			echo '{"result":"OK", "msg":"Movie marked as unwatched", "itm-id":"0"}';
		
		elseif($result == 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
			
		elseif($result == 'no-movie')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
		elseif($result == 0)
			echo '{"result":"FALSE", "msg":"Movie already marked as watched"}';
		
		else
			echo '{"result":"OK", "msg":"Movie marked as watched", "itm-id":"'.$result.'"}';

?>