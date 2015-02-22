<?php 
	if($lst_result){
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(isset($lst_result['ldt']))
			echo '{"result":"OK", "msg":"Your list created successfully.", "list-id":"'.$lst_result['lst'].'", "ldt-id":"'.$lst_result['ldt'].'"}';
			
		elseif($lst_result === 'no-list')
				echo '{"result":"OK", "msg":"List not created. Please try again later."}';
				
		elseif($lst_result === 'no-movie')
			echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			
		elseif($lst_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';
		
	}else{
		
		show_404();
		
	} 

?>