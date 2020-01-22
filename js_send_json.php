<?php
require_once("20191231.php");

if($_POST!=null){
  var_dump($_POST);
  echo ' post<br>';
}
if($_GET!=null){
  var_dump($_GET);
  echo ' get<br>';
}
if($_COOKIE!=null){
  var_dump($_COOKIE);
  echo ' cookie<br>';
}
$str_json = file_get_contents('php://input');
var_dump($str_json);
// var_dump($_POST);
echo ' js json<br>';

?>