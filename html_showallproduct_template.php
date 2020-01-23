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
#處理從 html_newpurchase 點擊來這個頁面的重複session問題。 一共 3 line
if(isset($_POST['unset_product_id_for_purchase'])){
  unset($_SESSION['product_id_for_purchase']);
}
#處理從 html_newsale 點擊來這個頁面的重複session問題。 一共 3 line
if(isset($_POST['unset_product_id_for_sale'])){
  unset($_SESSION['product_id_for_sale']);
}
#處理從 html_marketimage 點擊來這個頁面的重複session問題。 一共 3 line
if(isset($_POST['unset_product_id_for_image'])){
  unset($_SESSION['product_id_for_image']);
}
// var_dump($_GET);
require_once("html_navibar_template.php");
require_once('css_dropupbutton_template.php');



if(!isset($_SESSION['user_id'])){
  echo "<div id='echo17'>session 傳送失敗</div>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}else{
  require_once('login.php');
  $user_id=$_SESSION['user_id'];
  echo "<br><br><br>";
  $query ='select product_id from product where user_id ='.$user_id;
  $result=$conn->query($query);
  $product_rows=$result->num_rows;
  if($product_rows==0){
    echo"<div id='echo18'>您還沒有輸入任何的貨品，請先添加新的貨品</div>";
  }else{
    $query='select count(product_id) from product where user_id ='.$user_id;
    $stmt=$conn->query($query);
    if(!$stmt)echo($conn->error);
    $total_product_id=$stmt->fetch_assoc()['count(product_id)'];
    // var_dump($total_product_id);
    $total_page_number=$total_product_id/20;
    #便小數變為整數 三種 round 四捨五入 ceil 變為更大整數，floor變為更小整數。
    $total_page_number=ceil($total_page_number);
    // var_dump($total_page_number);
    
    if($total_product_id <=20){
    #使用了 login.php 的自定義function，可以直接output整個product table
    fetch_product_table($conn,$user_id);
    }
    if($total_product_id>20){
      if(isset($total_page_number)&&$total_page_number!=1){
        echo '<div class="dropup">
        <button id="echo9" class="dropbtn">翻頁</button>
        <div class="dropup-content">';
        for($i=7;$i<=$total_page_number&&$i>0;$i--){
          echo "<a href='html_showallproduct_template.php?page_number=$i'><span id='echo20'>第</span> $i <span id='echo21'>頁</span></a><br>";
        }
        echo '  </div>
        </div>';
        // var_dump($_GET['page_number']);
      }
      if(!isset($_GET['page_number'])){
        $_GET['page_number']=1;
        $offset='';
        fetch_product_table($conn,$user_id);
      }elseif($_GET['page_number']==1){
        $offset='';
        fetch_product_table($conn,$user_id);
      }
      if($_GET['page_number']>1){
        $offset = 20*$_GET['page_number']-20;
        $offset = $offset.',';
        // var_dump($offset);
        echo "<br>";
        fetch_product_table($conn,$user_id,$offset);
      }
      
    }
  }
}
?>















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
  <script id='jquery' src="jquery-3.4.1.js"></script>
  <!-- ripple effect library -->
  <script src="jquery.ripples.js"></script>
  <script id='bootstrap_js' src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script>
  <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
  <script id='jquery_cookie' src='/jquery-cookie-master/src/jquery.cookie.js'></script>
  <script id='vue' src="vue.min.js"></script>
  <link id='bootstrap' type='text/css' rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.min.css">
</head>

<body>
  <br><hr><hr>
  <a href="html_newproduct_template.php" class="button">
    <h4 id='echo22'>添加新的貨品，輸入貨品基本信息</h4>
  </a>
  <br><br><br>
  <label id='echo23'>輸入上面顯示的貨號，添加進貨記錄，出售記錄，圖片</label><br>
  <form method="post" action='html_newpurchase_template.php'>
    <label id="echo25">為這個貨號添加進貨記錄</label><br>
    <input type='number' min='1' max='9999999999' name='product_id_for_purchase' required>
    <input type='submit' id='value1' value='添加進貨記錄'>
  </form>
  <br><hr>
  <form method="post" action='html_newsale_template.php'>
    <label id="echo26">為這個貨號添加出售記錄</label><br>
    <input type='number' min='1' max='9999999999' name='product_id_for_sale' required>
    <input type='submit' id='value2' value='添加出售記錄'>
  </form>

  <br><hr>
  <label id="echo27">為這個貨號添加圖片或刪除圖片</label><br>
  <form method="post" action='html_marketimage_template.php'>
    <input type='number' min='1' max='9999999999' name='product_id_for_image' required>
    <input type='submit' id='value3' value='添加圖片或刪除圖片'>
  </form>

  <a href='html_displayimage_template.php' class='button'>
    <h3 id='echo24'>進入圖庫</h3>
  </a>
  <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
  <script id='js' defer async type=text/javascript src="html_showallproduct_template.js"></script>
</body>