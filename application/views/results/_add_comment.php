<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');

	if($result == -1 || $result === FALSE)
		echo '{"result":"FALSE","data":{"message":"An error occured, please try again later."}}';
	
	elseif($result == 'no-user')
		echo '{"result":"FALSE","data":{"message":"Please login before post a review."}}';
	
	else
		echo '{"result":"OK","data":{"message":"Your review posted successfully.","post":'.$result.'}}';


?>