<?php
session_start();
// var_dump($_SESSION);
require_once("html_navibar_template.php");
require_once("html_dropup_button_template.php");
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}
if(isset($_POST['buy_place']) && isset($_POST['product_info'])){
  require_once("login.php");
  $conn=new mysqli($host,$username,$password,$databasename);
  if($conn->connect_error){
    echo "無法連接數據庫，$databasename ， 回到註冊頁面","<br>";
    require_once ('test_header.php');
    exit();
  }
  $query = "insert into product values(
              ?,?,?,?)";
  $stmt=$conn->prepare($query);
  if(!$stmt)die('query 輸入格式錯誤');
  $user_id=$_SESSION['user_id'];
  $product_id=null;
  $buy_place=$_POST['buy_place'];
  $product_info=$_POST['product_info'];
  $stmt->bind_param('iiss',$user_id,$product_id,$buy_place,$product_info);
  if(!$stmt->execute()){
    echo "添加新貨號失敗， 回到註冊頁面","<br>";
    require_once ('test_header.php');
    exit();
  }
  $query="select product_id from product where user_id = ?";
  $stmt=$conn->prepare($query);
  if(!$stmt)die('query 找 product_id有问题');
  $stmt->bind_param('i',$user_id);
  if($stmt->execute())die('product_id query failed');
  $result_stmt=$stmt->get_result();
  $rows=$resutl_stmt->fetch_all(MYSQL_BOTH);
  var_dump($rows);
  header('location:html_newpurchase_template.php');
  exit();
}

echo <<<_HEREDOC
<br>
<br>
<br>
<form method='post' action='$_SERVER[PHP_SELF]'>
<label>請輸入進貨的地點</label><br>
<input type='text' name='buy_place' size='40'><br>
<label>請輸入貨品的簡要信息</label><br>
<input type='text' name='product_info' size='40'><br>
<input type='submit' value='創建新貨號'>
</form>
_HEREDOC;
