<?php

	$this->output->set_header('Content-Type: application/json; charset=utf-8');

		if($delete_result == 1)
			echo '{"result":"OK","data":{"message":"Your review data deleted successfully."}}';
      
    elseif($delete_result == -1)
			echo '{"result":"FALSE","data":{"message":"No review found to delete"}}';
		
		elseif($delete_result == 'no-user')
			echo '{"result":"FALSE","data":{"message":"Please login before post a review."}}';

?>