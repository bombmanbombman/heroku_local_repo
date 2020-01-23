<?php
session_start();
var_dump($_SESSION);
require_once("html_navibar_template.php");

if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}
require_once('login.php');
$query = 'select user_name,user_email,user_phone from user 
  where user_id = ?';
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
$user_id=$_SESSION['user_id'];
$stmt->bind_param('i',$user_id);
if(!$stmt->execute()){
  echo "select query failed 回到login頁面。<br>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}
$stmt->bind_result($user_name,$user_email,$user_phone);
$stmt->fetch();
// var_dump($user_name);
// var_dump($user_email);
// var_dump($user_phone);
$query1 = "select user_icon from user_icon
            where user_icon_id = ".$user_id;
$stmt2=$conn->query($query1);
if(!$stmt2){
  echo $conn->error;
  // require_once('test_header.php');
  exit();
}
// $user_icon_id = $user_id;
// $stmt2->bind_param('i',$user_icon_id);
// if(!$stmt2->execute()){
//   echo "select icon query2 failed 回到用戶頁面";
//   require_once('test_header.php');
//   exit();
// }
$row= $stmt2->fetch_assoc();
$user_icon=$row['user_icon'];
echo "<br><br><br>歡迎用戶 $user_name , 回到本站。<br>";
if($user_icon != null){
  echo '<img withd="80" height ="80" src="data:image/jpeg;base64,'.base64_encode($user_icon).'"/><br>';
}else {
  echo "<label>默認的頭像</label>";
  $no_icon = file_get_contents('C:/xampp/htdocs/laravelFolder/resources/views/learning_php/upload_compress/no_face.png');
  echo '<img withd="80" height ="80" src="data:image/jpeg;base64,'.base64_encode($no_icon).'"/><br>';
}
if($user_phone != null && $user_phone != '00000000000'){
  $_SESSION['user_phone']=$user_phone;
  echo "您的電話是 $user_phone 。<br>";
}else echo "您還未輸入電話<br>";
if($user_email!= null){
  $_SESSION['user_email']=$user_email;
  echo "您的郵箱是 $user_email 。<br>";
}else echo "您還未輸入郵箱<br>";

$query ='select product_id from product 
where user_id ='.$user_id;
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
if(!$stmt->execute())die("select product_id failed");
$result_stmt=$stmt->get_result();
// var_dump($result_stmt);
$num_rows=$result_stmt->num_rows;
// var_dump($num_rows===0);
// echo '<br>';

if($num_rows!==0){
  $progress2=true;
  $conn->close();
}

// if(isset($progress1)&&$progress1===true){
echo <<<_HEREDOC
<head>
<style>
a.button {
  -webkit-appearance: button;
  -moz-appearance: button;
  appearance: button;
  text-decoration: none;
  color: initial;
}
</style>
</head>
<body>
<a href="html_adduserdetail_template.php" class="button"><h1>補充修改用戶詳細信息</h1></a>
<br>
<br>
<br>
<a href="html_newproduct_template.php" class="button"><h1>添加新的貨品，輸入貨品基本信息</h1></a>
<br>
<br>
<br>
_HEREDOC;
if(isset($progress2)&&$progress2===true){
  // var_dump($progress2);
  // var_dump($_SESSION['user_id']);
  echo "<a href='html_showallproduct_template.php' class='button'><h1>進入全貨號管理頁面</h1></a>";
}
// }
// if($progress2===true){
  // echo <<<_HEREDOC
  // <head>
  // <style>
  // a.button {
    // -webkit-appearance: button;
    // -moz-appearance: button;
    // appearance: button;
    // text-decoration: none;
    // color: initial;
  // }
  // </style>
  // </head>
  // <body>
  // <a href="html_adduserdetail_template.php" class="button"><h1>補充修改用戶詳細信息</h1></a>
  // <br>
  // <br>
  // <br>
  // <a href="html_newproduct_template.php" class="button"><h1>添加新的貨品，輸入貨品基本信息</h1></a>
  // <br>
  // <br>
  // <br>
  // <a href='html_showallproduct_template.php' class='button'><h1>進入全貨號管理頁面</h1></a>
// _HEREDOC;
// }

echo "</body>";













































?>