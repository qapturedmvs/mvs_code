<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');

		if($edit_result == -1)
			echo '{"result":"FALSE","data":{"message":"No parent review found to reply."}}';
      
    elseif($edit_result == -2)
			echo '{"result":"FALSE","data":{"message":"Can`t edit replied reviews"}}';
		
		elseif($edit_result == 'no-user')
			echo '{"result":"FALSE","data":{"message":"Please login before post a review."}}';
		
		else
			echo '{"result":"OK","data":{"message":"Your review posted successfully."}}';


?>