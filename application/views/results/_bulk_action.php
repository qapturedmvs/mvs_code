<?php 
		
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		
		if($action == 'seen'){
		
			if($result == 0)
				echo '{"result":"FALSE", "msg":"Selected movies already in your seen list."}';
			
			elseif($result == 'no-user')
				echo '{"result":"FALSE", "msg":"User not found"}';
			
			else
				echo '{"result":"OK", "msg":"Selected movies marked as seen."}';
		
		}else{
			
			if($result == 0)
				echo '{"result":"FALSE", "msg":"Selected movies already in your watchlist."}';
			
			elseif($result == 'no-user')
				echo '{"result":"FALSE", "msg":"User not found"}';
			
			else
				echo '{"result":"OK", "msg":"Selected movies added to your watchlist"}';
			
		}
		
?>