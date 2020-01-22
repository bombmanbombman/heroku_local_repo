<?php
session_start();
#《不應該添加
// require_once("html_navibar_template.php");
#不應該添加》
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='https://bombmanbombman-project1.herokuapp.com/#';
  require_once ('test_header.php');
  exit();
}else{
require_once('login.php');
}
if(isset($_POST['user_email'])||isset($_POST['user_phone']) ||isset($_POST['user_icon'])){
  $query = 'update user set 
              user_email = ?,user_phone = ?
              where user_id = ?';
  $stmt=$conn->prepare($query);
  if(!$stmt){
    echo $conn->error;
    require_once('test_header.php');
    exit();
  }
  $user_id=$_SESSION['user_id'];
  $user_email = double_check_input($conn,$_POST['user_email']);
  $user_phone = double_check_input($conn,$_POST['user_phone']);
  // var_dump($user_phone);
  echo "<br>";
  
  $stmt->bind_param('ssi',$user_email,$user_phone,$user_id);
  if(!$stmt->execute()){
    echo $conn->error;
    require_once ('test_header.php');
    exit();
  }
  if(isset($_POST['user_phone']) && substr($_POST['user_phone'],0,1)==0){
    $query = "update user set user_phone=lpad(user_phone,11,'0') 
                where char_length(user_phone)<=11 and user_id = ?";
    $stmt=$conn->prepare($query);
    if(!$stmt)echo($conn->error);
    $user_phone = substr($_POST['user_phone'],1);
    // var_dump($user_phone);
    $stmt->bind_param('i',$user_id);
    $stmt->execute();
  }
  if(file_exists($_FILES['user_icon']['tmp_name'])&&$_FILES['user_icon'] != null){
    $query = 'delete user_icon from user_icon
                where user_icon_id = ?';
    $user_icon_id = $user_id;
    $stmt=$conn->prepare($query);
    if(!$stmt){
      echo "update query failed 回到用戶頁面";
      require_once('test_header.php');
      exit();
    }
    $stmt->bind_param('i',$user_icon_id);
    if(!$stmt->execute()){
      echo '添加頭像失敗，回到用戶頁面';
      require_once ('test_header.php');
      exit();
    }
    $user_icon = file_get_contents($_FILES['user_icon']['tmp_name']);
    $null=null;
    $query='insert into user_icon values(?,?,?)';
    $stmt=$conn->prepare($query);
    if(!$stmt){
      echo "update query failed 回到用戶頁面";
      require_once('test_header.php');
      exit();
    }
    $user_icon_id= $user_id;
    $stmt->bind_param('iib',$null,$user_icon_id,$user_icon);
    $stmt->send_long_data(2,$user_icon);
    if(!$stmt->execute()){
      echo '添加頭像失敗，回到用戶頁面';
      require_once ('test_header.php');
      exit();
    }
  }
  if(isset($_SESSION['user_email'])){
    unset($_SESSION['user_email']);
  }
  if(isset($_SESSION['user_phone'])){
    unset($_SESSION['user_phone']);
  }
  header('location:html_userdetail_template.php');
  if(!is_bool($stmt))$stmt->close();
  $conn->close();
  exit();
}
if(isset($_SESSION['user_email'])){
  $user_email=$_SESSION['user_email'];
}else $user_email =null;
if(isset($_SESSION['user_phone'])){
  $user_phone=$_SESSION['user_phone'];
}else $user_phone =null;
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
<br>
<br>
<br>

<h2>電話號碼，郵箱，可以幫助你找回並重設密碼</h2>
<form method='post' action='' enctype='multipart/form-data'>
<label>請輸入您的郵箱，中間必須帶有@的符號。</label><br>
<input type='eamil' value='$user_email' name='user_email' value=''><br>
<label>請輸入數字，不要自己添加'-'來隔開</label><br>
<input type='tel' value='$user_phone' pattern="^\d{11}$" 
maxlength ='11' name='user_phone' value=''><br>
<label>創建或修改頭像</label><br>
<input type='file' name='user_icon' ><br><br>
<input type='submit' value='添加'>
</form>
</body>
_HEREDOC;







































?>