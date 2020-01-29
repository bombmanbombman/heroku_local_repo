<!DOCTYPE html>
  <head>
    <title>new product ID</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html;     charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <!-- map 必须要的css -->
      <style>
      .container {
        padding-top: 30px;
        padding-bottom: 30px;
      }
      #map{
        background: #CCC;
      }
      ul {
        padding-top: 16px;
      }
      .media img {
        max-width: 64px;
      }
      .media h5, p {
        font-size: 14px;
      }
      .mdeia p {
        margin-bottom: 6px;
      }
      .media h6 {
        font-size: 12px;
        color: #CCC;
      }
      .fixed-bottom {
        position: fixed;
        left: 16px;
        bottom: 0;
        max-width: 320px;
      }
    </style>
    <link id='bootstrap' type='text/css' rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="canonical" href="https://letswrite.tw/google-map-api-place-api/">
    <link rel="shortcut icon" href="https://i0.wp.com/letswrite.tw/wp-content/uploads/2019/07/cropped-letswrite512-1.jpg"/>
    <!-- Google Tag Manager-->
    <script>
      (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-PGQ9WQT');
    </script>
    <script id='jquery' src="jquery-3.4.1.js"></script>
    <!-- ripple effect library -->
    <script src="jquery.ripples.js"></script>
    <script id='bootstrap_js' src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
    <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
    <script id='jquery_cookie' src='/jquery-cookie-master/src/jquery.cookie.js'></script>
    <script id='vue' src="vue.min.js"></script>
  </head>
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

  <!-- google map 显示的element -->
  <section id='google_map'>
    <div id="app" class="container">
      <!-- 搜尋框 -->
      <div class="row">
        <div class="col google-map">
          <h5>
            Search：
            <button id='echo8'>取得現在地</button>
          </h5>
          <div class="form-group">
            <input type="text" class="form-control" ref="site" v-model="site">
            
          </div>
        </div>
      </div>
      <!-- 放google map的div -->
      <!-- 用於change event -->
      <div id="map1"class="row">
        <div class="col google-map">
            <h5>Google Map：</h5>
          <div id="map" class="embed-responsive embed-responsive-16by9"></div>
        </div>
      </div>
      <hr>
      <!-- 用於click event -->
      <div id="map2"class="row" style="display:none">
        <div class="col google-map">
            <h5>Google Map：</h5>
          <div id="map" class="embed-responsive embed-responsive-16by9"></div>
        </div>
      </div>
      <hr>
      <!-- 放評論摘要的div -->
      <div class="row" v-if="place != null">
        <div class="col" v-if="place.reviews != null">
          <h5>評論：</h5>
          <div class="row" v-for="p in place.reviews">
            <div class="col">
              <ul class="list-unstyled">
                <li class="media">
                  <img :src="p.profile_photo_url" class="mr-3">
                  <div class="media-body">
                    <h5 class="mt-0 mb-1">
                      <a target="_blank" :href="p.author_url">{{ p.author_name }}</a>
                    </h5>
                    <p>{{ p.text }}</p>
                    <h6>{{ p.relative_time_description }}</h6>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <form method='post' action='<?php echo $_SERVER["PHP_SELF"];?>'>
  <label id='echo1'>請輸入進貨的地點</label><br>
  <input type='text' name='buy_place' size='40'required><br>
  <label id='echo2'>請輸入貨品的簡要信息</label><br>
  <input type='text' name='product_info' size='40'required><br>
  <label id='echo3'>請輸入貨品的詳細信息</label><br>
  <textarea name='product_detail' maxlength='255' rows='4' cols='50'></textarea>
  <br><br>
  <input id='value1' type='submit' value='創建新貨號'>
  </form>
  <?php 
  //翻頁button
    require_once("html_dropup_button_template.php");
  ?>
  <!-- 必须载入的js包含api key -->

  <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
  <script id='js' defer async type=text/javascript src='html_newproduct_template.js'></script>
  <section id='google_map_js'>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5lki3Wn7GU8gZllmCyWc9VgkVDrH-_OA&libraries=places&callback=initMap" async defer></script>
  </section>
  </body>
</html>

