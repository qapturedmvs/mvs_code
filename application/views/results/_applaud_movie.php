<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($applaud_result == 'unapplaud')
			echo '{"result":"OK", "action":"applaud", "msg":"Movie unapplauded"}';
		
		elseif($applaud_result == 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
		
		elseif($applaud_result == 0)
			echo '{"result":"FALSE", "msg":"Movie already applauded"}';
			
		else
			echo '{"result":"OK", "action":"unapplaud", "msg":"Movie applauded", "app-id":"'.$applaud_result.'"}';

?>