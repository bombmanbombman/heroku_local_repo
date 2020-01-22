<?php
if(isset($_POST['userage'])){
  $userage=$_POST['userage'];
  if($userage>=18)echo '1';
  if($userage<18)echo '0';
}

?>