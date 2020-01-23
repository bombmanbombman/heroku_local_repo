<?php
session_start();
require_once('html_navibar_template.php');
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}
if(isset($_POST['product_id'])){
  require_once('login.php');
  $user_id=$_SESSION['user_id'];
  // var_dump($_SESSION);
  $query = 'select * from product where product_id ='.$_POST['product_id'];
  $stmt=$conn->query($query);
  $num_rows=$stmt->num_rows;
  if($num_rows==0){
    echo "這個貨號不存在，請輸入存在的貨號。";
    $wait_time=6;
    $redirect='html_searchproduct_template.php';
    require_once('test_header.php');
  }
  if($num_rows!=0){
    $_SESSION['product_id']=$_POST['product_id'];
    header('location:html_productrecord_template.php');
    $conn->close();
    exit();
  }
}
#《測試
$user_id=$_SESSION['user_id'];
require_once('login.php');
fetch_product_table($conn,$user_id);
# 測試》







echo <<<_HEREDOC
<form method = 'post' action=''>
<label>請輸入要顯示詳情的貨號，進入進貨，賣出編輯頁面</label><br>
<input type='number' min='1' max='9999999999' name='product_id'>
<input type='submit' value='搜索'>
</form>

_HEREDOC;










?>