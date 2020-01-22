<?php //mysqli.php
//注意!!》》》使用完畢後要記得 $conn->close()
  require_once ('login.php');
  $conn = new mysqli($host,$username,$password,$datebasename);
  if($conn->connect_error){
    die($msg="fail to connect with mysqli class");
  echo<<<_HEREDOC
  We are sorry, but it was not possible to complete the requested task. The error message we got was:
  <p>$msg</p>
  Please click the back button on your browser and try again. If you are still having problems, please <a      
  href="mailto:admin@server.com">email our administrator</a>. Thank you.
_HEREDOC;  
  }  
?>