<?php
  
  if($results != '')
    foreach($results as $result)
      echo '<button data-itm-id="'.$result['ldt_fl'].'" data-prn-id="'.$result['list_id'].'" onclick="qptAction.customlist(this)" class="chkDefault chkCl">'.$result['list_title'].'</button>';
  
?>