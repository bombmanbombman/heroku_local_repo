<?php
require_once ("jumpback.php");
require_once ("login.php");
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error) die('database access failed');
$query = "insert into cats values (null,'Lion','leo','4')";
$result=$conn->query($query);
if(!$result) die('insert query failed');
$query="insert into cats values
  (null,'Cougar','Growler',2),
  (null,'Cheetah','Charly',3),
  (null,'Domestic Cat','nikulu',5)";
$result = $conn->query($query);
if(!$result) die('insert query failed second');

echo "insert completed.<br>";

if(!is_bool($result))$result->close();
$conn->close();

























?>