<?php
$username='admin';
$password='63079861';
if(isset($_SERVER['PHP_AUTH_USER'])&&isset($_SERVER['PHP_AUTH_PW'])){
  if($_SERVER['PHP_AUTH_USER']==$username && $_SERVER['PHP_AUTH_PW']==$password){
    echo "You are now logged in<br>";
  }else{
    die("invalid username/password combination");
  }
}else{
  header('WWW-Authenticate: Basic realm="restricted Area"');
  header('HTTP/1.0 401 Unauthorized');
  die("Please enter you username and password");
}




#100012476412




?>