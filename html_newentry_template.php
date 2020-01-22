<?php
session_start();
#《不應該添加
// require_once("html_navibar_template.php");
#不應該添加》
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
}else{
require_once('login.php');
$query = 'select user_name from user 
            where user_id = ?';
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
$user_id=$_SESSION['user_id'];
$stmt->bind_param('i',$user_id);
if(!$stmt->execute()){
  echo "select query failed 回到註冊頁面。<br>";
  $redirect='html_userregister_template.php';
  require_once ('test_header.php');
  exit();
}
$result_stmt=$stmt->get_result();
$user_name=$result_stmt->fetch_assoc()['user_name'];
echo "<br><br><br>歡迎新用戶 $user_name , 這是您的用戶頁面<br>";
if(isset($_SESSION['user_email'])||isset($_SESSION['user_phone'])){
  unset($_SESSION['user_email']);
  unset($_SESSION['user_phone']);
}
}


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
<pre>
<a href="html_adduserdetail_template.php" class="button"><h1> 補充用戶詳細信息 </h1></a>
<br>
<br>
<br>
<br>
<a href="html_userdetail_template.php" class="button"><h1> 進入用戶頁面 </h1></a>
</pre>
_HEREDOC;













if(!is_bool($stmt))$stmt->close();
$conn->close();
?>