<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');
	
	switch($comment_result){
		
		case 'success':
			echo '{"result":"OK","data":{"message":"Your comment posted successfully.","post":'.$feed.'}}';
		break;
		
		case 'error':
			echo '{"result":"FALSE","data":{"message":"An error occured. Please try again later."}}';
		break;
		
		case 'no-user':
			echo '{"result":"FALSE","data":{"message":"Please login before post a comment."}}';
		break;
		
	}

?>