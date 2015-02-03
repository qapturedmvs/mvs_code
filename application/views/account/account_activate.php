<?php
if($act === TRUE){
  echo 'ACTIVATION SUCCESS!!!';
}elseif($act === 'activatedBefore'){
  echo 'THIS ACCOUNT ALREADY ACTIVATED!!!';
}elseif($act === 'noAccount'){
  echo 'ACCOUNT NOT FOUND!!!';
}else{
  echo 'AN ERROR OCCURED!!!';
}
?>