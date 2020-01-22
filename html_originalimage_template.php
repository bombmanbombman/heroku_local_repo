<?php
session_start();
// var_dump($_SESSION);
require_once ('login.php');
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='https://bombmanbombman-project1.herokuapp.com/#';
  require_once ('test_header.php');
  exit();
}
if(!isset($_GET['image_id'])){
  echo "href 的編輯有問題";
}
$query = "select image_data from image
            where user_id = ? and image_id = ?";
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
$user_id=$_SESSION['user_id'];
$stmt->bind_param('ii',$user_id,$_GET['image_id']);
if(!$stmt->execute())die('query 執行錯誤');
$result_stmt=$stmt->get_result();
while($row=$result_stmt->fetch_assoc()){
  // echo "<a  href='html_originalimage_template.php?image_id=",urlencode($image_id),"'><img src='data:image/jpeg;base64,".base64_encode($row["image_data"])."'/></a>";
  echo "<img src='data:image/jpeg;base64,".base64_encode($row["image_data"])."'/>";
}