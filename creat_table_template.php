<?php
require_once('jumpback.php');
require_once('login.php');
$conn= new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)echo 'fail to connecting database <br>';
$query = 'create table cats(
  id smallint not null auto_increment,
  family varchar(32) not null,
  name varchar(32) not null,
  age tinyint not null,
  primary key(id)
)ENGINE InnoDB';
$result = $conn->query($query);
if(!$result)echo 'fail to creating table<br>
or table is already existed<br>';
else echo "table has been created.<br>";
if(!is_bool($result))$result->close();
$conn->close();































?>