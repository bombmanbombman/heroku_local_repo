<?php
$URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
if(strpos($URL,'herokuapp.com')){
  // echo "<div>$URL</div>";
}else{
  // echo "<div>$URL</div>";
}
if(isset($_POST) && $_POST != false){
  // var_dump($_POST);
  // echo "post <br>";
}
if(isset($_COOKIE) && $_COOKIE != false){
  // var_dump($_COOKIE);
  // echo 'cookie <br>';
}
if(isset($_SESSION)&&$_SESSION!=null){
  // var_dump($_SESSION);
  // echo 'session<br>';
}
if(isset($_POST['user_name'])&&isset($_POST['user_password'])){
  session_start();
  require_once ('login.php');
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
  $_SESSION['user_name']=$_POST['user_name'];
  if($_SESSION['user_id']==null){
    echo "error0";
  }else{
    // echo '<meta http-equiv="refresh" content="0; url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_userdetail_template.php" />';
    echo $_SESSION['user_id'];
    echo '||';
    echo $_SESSION['user_name'];
  }
}



?>