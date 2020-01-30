
<?php
if(isset($_SESSION)){
  session_destroy();
}
session_start();
if(isset($_POST["user_name"]) && isset($_POST["user_password"])){
  require_once('login.php');
  $query = 'INSERT INTO user (user_name,user_password) VALUES(?,?)';
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $user_name=double_check_input($conn,$_POST['user_name']);
  $user_password = double_check_input($conn,$_POST['user_password']);
  $stmt->bind_param('ss',$user_name,$user_password);
  if(!$stmt->execute()){
  echo "這個用戶名，已經被其他人註冊了。";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
  }
  $query = "select user_id from user 
              where user_name = ? and user_password = ?";
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error+' query錯誤');
  // var_dump($stmt);
  $stmt->bind_param('ss',$user_name,$user_password);
  $stmt->execute();
  $result_stmt=$stmt->get_result();
  $row=$result_stmt->fetch_assoc()['user_id'];
  // var_dump($row);
  // echo "<br>";
  if(!is_bool($stmt))$stmt->close();
  $conn->close();
  $_SESSION['user_id']=$row;
  echo '成功';
  // header("location:html_newentry_template.php");
}

//插入http template
// require_once("html_navibar_template.php");
// require_once("html_dropup_button_template.php");






?>














