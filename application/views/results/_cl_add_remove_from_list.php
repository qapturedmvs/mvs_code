<?php 

		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($lst_result == -2)	
			echo '{"result":"FALSE", "msg":"Custom list not found."}';

		elseif($lst_result == -1)
				echo '{"result":"FALSE", "msg":"Movie not found."}';
				
		elseif($lst_result == 0)
				echo '{"result":"FALSE", "msg":"Movie already in that list."}';
		
		elseif($lst_result == 'rfcl')
				echo '{"result":"OK", "action":"atcl", "msg":"Movie removed from your list"}';
				
		else
				echo '{"result":"OK", "action":"rfcl", "msg":"Movie added your list", "ldt-id":"'.$lst_result.'"}';

?>