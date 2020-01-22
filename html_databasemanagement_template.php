<?php
session_start();
require_once ('html_navibar_template.php');
if(!isset($_SESSION['user_id'])){
  echo "<div>网络问题，回到註冊页面</div>";
  require_once('test_header.php');
}
require_once ('login.php');
$conn=new mysqli($host,$username,$password,$databasename);
if($conn->connect_error){
  echo "<div><span>無法連接數據庫:</span>$databasename <span>， 回到註冊頁面</span></div>";
  require_once('test_header.php');
  exit();
}
$query = "(select product_id from product where user_id = {$_SESSION['user_id']})";
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
if(!$stmt->execute()){
  echo "select product_id query failed，回到註冊頁面";
  require_once('test_header.php');
}
$result_stmt=$stmt->get_result();
$rows=array();
while($row=$result_stmt->fetch_array(MYSQLI_BOTH)){
  $rows[]=$row;
};
var_dump($rows);
$conn->close();

























?>