<?php 
	if($json){
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo $json;
	}else{
		echo "Access Denied";
	} 

?>