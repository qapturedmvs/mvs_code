<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($rate_result == 'no-user' || $rate_result == -1)
			echo '{"result":"FALSE", "msg":"User not found"}';
			
		else
			echo '{"result":"OK", "msg":"Rated successfuly", "rate-id":'.$rate_result.'}';

?>