<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');
	
	if($check_nick_result){
		
		
		
		if($check_nick_result === TRUE)
			echo '{"result":"OK", "status":"DONE", "msg":"Nick is available", "nick":"'.$nick.'"}';
			
		elseif($check_nick_result === 'no-nick')
				echo '{"result":"FALSE", "msg":"No nick found"}';
			
		elseif($check_nick_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
		
	}else{
		
		echo '{"result":"OK", "status":"FAIL", "msg":"Nick is unavailable"}';
		
	} 

?>