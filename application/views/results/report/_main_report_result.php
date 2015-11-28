<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($result !== 0)
			echo '{"result":"OK", "msg":"Feedback sent successfully.", "itm-id":"'.$result.'"}';
			
		else
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			

?>