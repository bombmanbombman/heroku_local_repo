<?php
require_once ("jumpback.php");
require_once ('login.php');
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("failed to access $databasename");
$query = "update cats set name = 'asura' where id=11";
$result = $conn->query($query);
if(!$result) die('update query failed');
echo "update db success.<br>";

if(!is_bool($result)) $result->close();
$conn->close();




























?>