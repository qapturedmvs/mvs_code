<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		switch($lst_result){
		
			case 'dcl':
				echo '{"result":"OK", "msg":"List deleted successfully."}';
			break;
			
			case 'no-list':
				echo '{"result":"FALSE", "msg":"An error occured. Please try again later."}';
			break;
			
			case 'no-user':
				echo '{"result":"FALSE", "msg":"User not found"}';
			break;
			
		}

?>