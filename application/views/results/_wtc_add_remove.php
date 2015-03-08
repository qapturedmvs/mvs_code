<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($wtc_result)){
			
			echo '{"result":"OK", "action":"rwtc", "msg":"Movie added to watchlist.", "wtc-id":"'.$wtc_result.'"}';
			
		}else{
			
			switch($wtc_result){
				
				case 'rwtc':
					echo '{"result":"OK", "action":"awtc", "msg":"Movie removed from watchlist."}';
				break;
						
				case 'no-movie':
					echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
				break;
					
				case 'no-user':
					echo '{"result":"FALSE", "msg":"User not found"}';
				break;
			
			}
			
		}

?>