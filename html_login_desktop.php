<?php
if(isset($_SESSION['user_id'])){
  unset($_SESSION['user_id']);
}
if(isset($_SESSION['product_id'])){
  unset($_SESSION['product_id']);
}
if(isset($_SESSION['purchase_id'])){
  unset($_SESSION['purchase_id']);
}
if(isset($_SESSION['accident_disconnect'])){
  unset($_SESSION['accident_disconnect']);
}
if(isset($_SESSION)&&$_SESSION!=null){
  var_dump($_SESSION);
  echo '<br>';
  session_destroy();
  session_regenerate_id(true);
}
echo "<br>";
if(isset($_POST['user_name']) && isset($_POST['user_password'])){
  session_start();
  require_once ('login2_for_desktop.php');
  $query = "select user_id from user 
              where user_name = ? and user_password =?";
  $stmt=$conn->prepare($query);
  if(!$stmt){
    echo "prepare stmt failed";
    require_once('test_header.php');
    exit();
  }
  $user_name=double_check_input($conn,$_POST['user_name']);
  $user_password=double_check_input($conn,$_POST['user_password']);
  $stmt->bind_param('ss',$user_name,$user_password);
  if(!$stmt->execute()){
    require_once('test_header.php');
    exit();
  }
  $result_stmt=$stmt->get_result();
  $_SESSION['user_id']=$result_stmt->fetch_assoc()['user_id'];
  // var_dump($_SESSION['user_id']);
  if($_SESSION['user_id']==null){
    echo '用戶名不存在，或密碼錯誤，請先註冊。<br>';
  }else{
    echo '<meta http-equiv="refresh" content="0; url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_userdetail_template.php" />';
    $conn->close();
  }
}

echo <<<_HEREDOC
<html>
<head>
<title>login page</title>
<style type="text/css">
</style>
</head>
<body>
<form action ='html_login_template.php' method = 'post'>
<input type='text' name='user_name' required placeholder='請輸入姓名'>
<input type='password' maxlength='12' name = 'user_password' required placeholder='請輸入密碼'>
<input type='submit' value='LOG IN'>
</form>
<form action ='html_userregister_template.php' method = 'post'>
<label>沒有用戶名? 請點擊signup進入註冊頁面</label><br>
<input type='submit' name='jump' value="sign up" required>
</form>
</body>
</html>
_HEREDOC;

?>