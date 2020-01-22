<?php
session_start();
require_once ('html_navibar_template.php');
if(!isset($_SESSION['user_id'])){
  echo "网络问题，回到用户页面";
  header("location:html_newentry_template.php");
}
require_once ('login.php');
$conn=new mysqli($host,$username,$password,$databasename);
if($conn->connect_error){
  echo "無法連接數據庫，$databasename ， 回到註冊頁面","<br>";
  header("refresh:2;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_newentry_template.php");
  exit();
}
$query = "(select product_id from product where user_id = {$_SESSION['user_id']})";
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
if(!$stmt->execute()){
  echo "select product_id query failed";
  header("refresh:2;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_newentry_template.php");
}
$result_stmt=$stmt->get_result();
$rows=array();
while($row=$result_stmt->fetch_array(MYSQLI_BOTH)){
  $rows[]=$row;
};
var_dump($rows);
$conn->close();

























?>