<?php 

		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($lst_result)){
			
			echo '{"result":"OK", "action":"rfcl", "msg":"Movie added your list", "ldt-id":"'.$lst_result.'"}';
			
		}else{
		
			switch($lst_result){
				
				case 'rfcl':
					echo '{"result":"OK", "action":"atcl", "msg":"Movie removed from your list"}';
				break;
				
				case 'no-list':
					echo '{"result":"FALSE", "msg":"Custom list not found."}';
				break;
					
				case 'movie-in-list':
					echo '{"result":"FALSE", "msg":"Movie already in that list."}';
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