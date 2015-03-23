<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if(isset($lst_result['list_id']) && $lst_result['list_id'] !== 0 && $lst_result['list_id'] !== -1)
			echo '{"result":"OK", "msg":"Your list created successfully.", "list-id":"'.$lst_result['list_id'].'", "ldt-id":"'.$lst_result['ldt_id'].'"}';
			
		elseif($lst_result['list_id'] === 0)
			echo '{"result":"FALSE", "msg":"List not created. Please try again later."}';
			
		elseif($lst_result['list_id'] === -1)
			echo '{"result":"FALSE", "msg":"Movie not found."}';
			
		elseif($lst_result === 'no-user')
			echo '{"result":"FALSE", "msg":"User not found"}';

?>