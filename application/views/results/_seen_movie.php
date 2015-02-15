<?php 
	if($seen_result){
		
		if($seen_result === TRUE){
			if(isset($action))
				echo ($action == 'seen') ? 'unseen' : 'seen';
			else
				echo 'All selected movies marked as seen';
			
		}elseif($seen_result === 'no-movie')
			echo 'An error occured. Please try again later.';
			
		elseif($seen_result === 'no-user')
			echo 'User not found';
		
	}else{
		
		show_404();
		
	} 

?>