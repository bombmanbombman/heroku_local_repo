<?php
require_once ("jumpback.php");
require_once ("login.php");
$conn=new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("failed to connected db $databasename");
$query = "insert into cats values
            (null,'Lynx','Stumpy',5)";
$result=$conn->query($query);
if(!$result)die("failed to insert new record");
echo "succeed inserting new record";
echo "the insert id is:".$conn->insert_id;
if(!is_bool($result))$result->close();
$conn->close();


























?>