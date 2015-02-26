<?php 
	if($lst_result){
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($lst_result === TRUE)
			echo '{"result":"OK", "msg":"Selected movies removed from your list."}';
			
		elseif($lst_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found."}';
			
		else
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
	}else{
		
		show_404();
		
	} 

?>