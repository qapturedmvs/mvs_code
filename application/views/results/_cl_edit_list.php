<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($seen_result === TRUE)
			echo '{"result":"OK", "msg":"List title updated successfully."}';
			
		elseif($seen_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}'; 

?>