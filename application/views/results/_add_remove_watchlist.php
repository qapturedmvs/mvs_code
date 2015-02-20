<?php 
	if($wtc_result){
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($wtc_result))
			echo '{"result":"OK", "action":"rwtc", "msg":"Movie added to watchlist.", "wtc-id":"'.$wtc_result.'"}';
			
		elseif($wtc_result === 'rwtc')
				echo '{"result":"OK", "action":"awtc", "msg":"Movie removed from watchlist."}';
				
		elseif($wtc_result === 'no-movie')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
		elseif($wtc_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
		
	}else{
		
		show_404();
		
	} 

?>