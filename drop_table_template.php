<?php
require_once ('jumpback.php');
require_once ('login.php');
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)echo "failed to connecting $databasename<br>";
$query ='drop table cats';
$result = $conn->query($query);
if(!$result)die('failed to drop table');
echo "table has beed droped<br>";
if(!is_bool($result))$result->close();
$conn->close();





















?>