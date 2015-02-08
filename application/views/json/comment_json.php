<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');
	
	if($comment_result === 'success'){
		
		echo '{"result":"OK","data":{"message":"Your comment posted successfully.","post":'.$feed.'}}';
		
	}elseif($comment_result === 'error'){
		
		echo '{"result":"FALSE","data":{"message":"An error occured. Please try again later."}}';
		
	}elseif($comment_result === 'no-user'){
		
		echo '{"result":"FALSE","data":{"message":"Please login before post a comment."}}';
		
	}else{
		
		show_404();
		
	} 

?>