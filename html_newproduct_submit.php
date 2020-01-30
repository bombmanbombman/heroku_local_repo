<?php
session_start();
if(!isset($_SESSION['user_id'])){
  echo "<div id='echo4'>session 傳送失敗</div>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}
if(isset($_POST['buy_place']) && isset($_POST['product_info'])){
  require_once("login.php");
  $query = "insert into product values(
              ?,?,?,?,?,?,?)";
  $stmt=$conn->prepare($query);
  $user_id=$_SESSION['user_id'];
  // var_dump($user_id);
  $product_id=null;
  $buy_place=double_check_input($conn,$_POST['buy_place']);
  $product_info=double_check_input($conn,$_POST['product_info']);
  $product_detail=double_check_input($conn,$_POST['product_detail']);
  $latitude=double_check_input($conn,$_POST['latitude']);
  $longitude=double_check_input($conn,$_POST['longitude']);
  $stmt->bind_param('iisssss',$user_id,$product_id,$buy_place,$product_info,$product_detail,$latitude,$longitude);
  if(!$stmt->execute()){
    echo "<div id='echo7'>添加新貨號失敗， 回到註冊頁面</div>";
    require_once ('test_header.php');
    exit();
  }
  $query="select product_id from product 
            where user_id = ? order by product_id desc limit 1"
            ;
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $stmt->bind_param('i',$user_id);
  if(!$stmt->execute())die('product_id query failed');
  $result_stmt=$stmt->get_result();
  // var_dump($result_stmt);
  $rows=$result_stmt->fetch_array();
  $_SESSION["product_id"]=$rows[0];
  // var_dump($_SESSION["product_id"]);
  header('location:html_showallproduct_template.php');
  exit();
}
?>