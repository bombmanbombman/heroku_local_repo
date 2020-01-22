<?php
require_once ('jumpback.php');
require_once ('login.php');
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("cannot connect to $databasename");
$stmt=$conn->prepare('insert into cats values
                        (?,?,?,?)');
if(!$stmt)echo($conn->error);
$stmt->bind_param("isss",$id,$family,$name,$age);
$id = 0;
$family='pather';
$name='mark four';
$age='76';

$stmt->execute();
printf("%d Row inserted.\n",$stmt->affected_rows);

require_once ("select_from_table_template.php");
if(!is_bool($stmt))$stmt->close();




























?>