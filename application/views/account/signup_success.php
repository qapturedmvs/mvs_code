<?php
if($mail_link){
  echo 'NEW MEMBER SUCCESS!!!';
  echo 'YOUR ACTIVATION LINK: <a href="'.$mail_link.'">'.$mail_link.'</a>';
}else{
  echo 'AN ERROR OCCURED!!!';
}
?>