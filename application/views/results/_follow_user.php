<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($result == -1)
			echo '{"result":"OK", "msg":"User not following anymore", "itm-id":"0"}';
		
		elseif($result == 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
			
		elseif($result == 'no-data')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
		elseif($result == 0)
			echo '{"result":"FALSE", "msg":"You are already following this user"}';
		
		else
			echo '{"result":"OK", "msg":"You are following this user", "itm-id":"'.$result.'"}';

?>