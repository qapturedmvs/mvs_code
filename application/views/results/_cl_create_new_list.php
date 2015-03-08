<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(isset($lst_result['ldt'])){
			
			echo '{"result":"OK", "msg":"Your list created successfully.", "list-id":"'.$lst_result['lst'].'", "ldt-id":"'.$lst_result['ldt'].'"}';
			
		}else{
			
			switch($lst_result){
				
				case 'no-list':
					echo '{"result":"OK", "msg":"List not created. Please try again later."}';
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