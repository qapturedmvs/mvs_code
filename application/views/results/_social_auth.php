<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');

	if($result)
		echo '{"result":"OK","data":{"message":"Success!"}}';
	
	else
		echo '{"result":"FALSE","data":{"message":"An error occured."}}';


?>