<?php
if(isset($_POST) && $_POST != false){
  var_dump($_POST);
  echo "post <br>";
}
if(isset($_COOKIE)){
  var_dump($_COOKIE);
  echo 'cookie <br>';
}
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
  // var_dump($_SESSION['user_id']);
  if($_SESSION['user_id']==null){
  }else{
    // echo '<meta http-equiv="refresh" content="0; url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_userdetail_template.php" />';
    echo '<meta http-equiv="refresh" content="0; url=html_userdetail_template.php" />';
    $conn->close();
  }
}
?>


<html>
<head>
<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="480318055682-j8ceeor3okjafa9bo1uvllmrkdoibi8b.apps.googleusercontent.com 
">
<title>login page</title>
<!-- google sign in api -->
<!-- <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script> -->
<script id='jquery' src="jquery-3.4.1.js"></script>
<!-- ripple effect library -->
<script src="jquery.ripples.js"></script>
<script id='bootstrap_js' src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
<script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
<script id='jquery_cookie' src='/jquery-cookie-master/src/jquery.cookie.js'></script>
<script id='vue' src="vue.min.js"></script>
<link id='bootstrap' type='text/css' rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.min.css">

<style type="text/css">
/* body{ */
  /* width:100%; */
  /* height:100%; */
  /* background: url("/upload_compress/background_rainbow1.png"); */
  /* -webkit-background-size: 100%; */
  /* -moz-background-size: 100%; */
  /* -o-background-size: 100%; */
  /* background-size: 100% 100%; */
  /* background-repeat:no-repeat; */
/* } */
/* #background{
  background :url("/upload_compress/background_water5.jpg");
  width:100%;
  height:auto;
} */
</style>
</head>
<body >
  <div id='background'></div>
  <!-- <div>test live server ne</div> -->
  <section id='content'>
    <div class="dropdown"> 
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" 
      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> language toggle </button> 
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
        <a id='japanese' class="dropdown-item active actived-language" href="#">日本語</a> 
        <a id='chinese' class="dropdown-item" href="#">繁體中文</a> 
        <a id='english' class="dropdown-item" href="#">english</a> 
      </div> 
    </div>
    <!-- <div id='background'></div> -->
    <!-- google signin api content -->
    <section id='flex_container' class='d-flex flex-column'style="color:white;font:bold;font-size:15px;">
    <div class="d-flex justify-content-center">
      <div id='google_sign_in' class="g-signin2 " data-onsuccess="onSignIn" data-theme="dark"></div>
      <br><button id='google._sign_out' class="align-items-start">google sign out</button>
    </div class="d-flex justify-content-center">
      <form  action ='index.php' method = 'post'>
      <div class="d-flex justify-content-center">
        <label id='echo1'>ユーザー名</label>
        <input type='text' name='user_name' required >
      </div>
      <div class="d-flex justify-content-center">
        <label id='echo2'>パスワード</label>
        <input type='password' maxlength='12' name = 'user_password' required>
      </div>
      <div class="d-flex justify-content-center" >
        <input class='btn btn-dark' type='submit' style="width:42%;" value='LOG IN'>
      </div>
      </form>
      <form class="d-flex justify-content-center" action ='html_userregister_template.php' method = 'post'>
        <label id='echo3'>新しいユーザーを作る</label>
        <input class='btn btn-dark' type='submit' name='jump' value="sign up" required>
      </form>
    </section>
    <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
    <script id='js' defer async type=text/javascript src="index.js"></script>


    <noscript>please do not turn off javascript</noscript>
  </section>
</body>
</html>

