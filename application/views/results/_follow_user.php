<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($follow_result))
			echo '{"result":"OK", "action":"unfollow", "msg":"You are following this user", "flw-id":"'.$follow_result.'"}';
			
		elseif($follow_result === 'unfollow')
			echo '{"result":"OK", "action":"follow", "msg":"User not following anymore"}';
			
		elseif($follow_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';

?>