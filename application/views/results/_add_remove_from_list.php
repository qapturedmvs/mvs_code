<?php 
	if($lst_result){
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(is_numeric($lst_result))
			echo '{"result":"OK", "action":"rfcl", "msg":"Movie added your list", "ldt-id":"'.$lst_result.'"}';
			
		elseif($lst_result === 'rfcl')
			echo '{"result":"OK", "action":"atcl", "msg":"Movie removed from your list"}';
		
		elseif($lst_result === 'no-list')
			echo '{"result":"FALSE", "msg":"Custom list not found."}';
			
		elseif($lst_result === 'movie-in-list')
			echo '{"result":"FALSE", "msg":"Movie already in that list."}';
		
		elseif($lst_result === 'no-movie')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
		elseif($lst_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
		
	}else{
		
		show_404();
		
	} 

?>