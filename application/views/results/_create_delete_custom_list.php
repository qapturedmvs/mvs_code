<?php 
	if($lst_result){
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($lst_result))
			echo '{"result":"OK", "action":"dcl", "msg":"Your list created successfully.", "list-id":"'.$lst_result.'"}';
			
		elseif($lst_result === 'dcl')
				echo '{"result":"OK", "action":"cncl", "msg":"Your list deleted."}';
				
		elseif($lst_result === 'no-movie')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
		elseif($lst_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
		
	}else{
		
		show_404();
		
	} 

?>