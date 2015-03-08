<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($seen_result)){
			echo '{"result":"OK", "action":"unseen", "msg":"Movie marked as seen", "seen-id":"'.$seen_result.'"}';
		
		}else{
			
			switch($seen_result){
				
				case 'unseen':
					echo '{"result":"OK", "action":"seen", "msg":"Movie marked as unseen"}';
				break;
					
				case 'mseen':
					echo '{"result":"OK", "action":"mseen", "msg":"All selected movies marked as seen"}';
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