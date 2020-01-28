<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;     charset=utf-8" />
    <script id='jquery' src="jquery-3.4.1.js"></script>
    <!-- ripple effect library -->
    <script src="jquery.ripples.js"></script>
    <script id='bootstrap_js' src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
    <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
    <script id='jquery_cookie' src='/jquery-cookie-master/src/jquery.cookie.js'></script>
    <script id='vue' src="vue.min.js"></script>
    <link id='bootstrap' type='text/css' rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.min.css">
  </head>
  <style>
    /* Always set the map height explicitly to define the   size  of the div
     * element that contains the map. */
    #map {
      height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
  <body>
<?php
$URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
if(strpos($URL,'herokuapp.com')){
  echo "<div>$URL</div>";
}else{
  echo "<div>$URL</div>";
}
session_start();
if(isset($_POST) && $_POST != false){
  var_dump($_POST);
  echo "post <br>";
}
if(isset($_COOKIE)){
  var_dump($_COOKIE);
  echo 'cookie <br>';
}
if(isset($_SESSION)){
  var_dump($_SESSION);
  echo 'session <br>';
}
require_once("html_navibar_template.php");
if(!isset($_SESSION['user_id'])){
  echo "<div id='echo4'>session 傳送失敗</div>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}
if(isset($_POST['buy_place']) && isset($_POST['product_info'])){
  require_once("login.php");
  $conn=new mysqli($host,$username,$password,$databasename);
  if($conn->connect_error){
    echo "<div><span id='echo5'>無法連接數據庫，</span> $databasename ， <span id='echo6'>回到註冊頁面</span></div>";
    require_once ('test_header.php');
    exit();
  }
  $query = "insert into product values(
              ?,?,?,?,?)";
  $stmt=$conn->prepare($query);
  $user_id=$_SESSION['user_id'];
  // var_dump($user_id);
  $product_id=null;
  $buy_place=double_check_input($conn,$_POST['buy_place']);
  $product_info=double_check_input($conn,$_POST['product_info']);
  $product_detail=double_check_input($conn,$_POST['product_detail']);
  $stmt->bind_param('iisss',$user_id,$product_id,$buy_place,$product_info,$product_detail);
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

  <br>
  <br>
  <br>
  <section id='google_map'>
    <div id="map"></div>
  </section>
  <form method='post' action='<?php echo $_SERVER["PHP_SELF"];?>'>
  <label id='echo1'>請輸入進貨的地點</label><br>
  <input type='text' name='buy_place' size='40'required><br>
  <label id='echo2'>請輸入貨品的簡要信息</label><br>
  <input type='text' name='product_info' size='40'required><br>
  <label id='echo3'>請輸入貨品的詳細信息</label><br>
  <textarea name='product_detail' maxlength='255' rows='8' cols='50'></textarea>
  <br><br>
  <input id='value1' type='submit' value='創建新貨號'>
  </form>
  <?php 
  //翻頁button
    require_once("html_dropup_button_template.php");
  ?>

  <section id='google_map_js'>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAehEZQIPxSSrInvV-wg9MZperouR5Ya5c&region=JP&language=ja&callback=initMap" async defer></script>
    <script async defer src='google_map.js'></script>
  </section>
  <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
  <script id='js' defer async type=text/javascript src='html_newproduct_template.js'></script>
  </body>
</html>

