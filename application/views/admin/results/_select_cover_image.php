<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');

		if($cover_result === TRUE)
			echo '{"result":"OK","data":{"message":"Cover image selected successfully."}}';
      
    else
			echo '{"result":"FALSE","data":{"message":"An error occured. '.$cover_result.'"}}';


?>