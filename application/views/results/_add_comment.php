<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');

	if($comment_result == -1)
		echo '{"result":"FALSE","data":{"message":"No parent review found to reply."}}';
	
	elseif($comment_result == 'no-user')
		echo '{"result":"FALSE","data":{"message":"Please login before post a review."}}';
	
	else
		echo '{"result":"OK","data":{"message":"Your review posted successfully.","post":'.$comment_result.'}}';


?>