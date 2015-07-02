<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');

	if($comment_result == -1 || $comment_result === FALSE)
		echo '{"result":"FALSE","data":{"message":"An error occured, please try again later."}}';
	
	elseif($comment_result == 'no-user')
		echo '{"result":"FALSE","data":{"message":"Please login before post a review."}}';
	
	else
		echo '{"result":"OK","data":{"message":"Your review posted successfully.","post":'.$comment_result.'}}';


?>