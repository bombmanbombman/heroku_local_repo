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
  echo "session 傳送失敗<br>";
  $redirect='html_login_template.php';
  require_once ('test_header.php');
  exit();
}
if(isset($_POST['product_id_for_image'])){
  $_SESSION['product_id_for_image']=$_POST['product_id_for_image'];
}

#計算這個product_id已經上傳的圖片數量。之後有6張的限制。
require_once("login.php");
$user_id = $_SESSION['user_id'];
$product_id=$_SESSION['product_id_for_image'];
$query = 'select count(image_id) from image 
          where user_id ='.$user_id.' and product_id ='.$product_id;
$stmt=$conn->query($query);
if(!$stmt)die ($conn->error);
$row=$stmt->fetch_assoc();
$image_number_of_this_product=($row)['count(image_id)'];
#將圖片存儲到variable中，associative array datatype,之後可以用foreach 呼出
$query = 'select image_data,image_id from image 
            where user_id ='.$user_id.' and product_id ='.$product_id;
$stmt=$conn->query($query);
$all_image_data_of_this_product =array();
$all_image_id_of_this_product=array();
while($row=$stmt->fetch_assoc()){
  $all_image_data_of_this_product[]=$row['image_data'];
  $all_image_id_of_this_product[]=$row['image_id'];
}

echo "<br><br><br>";
#尋找product_id_for_image是否存在image table中。
$query ='select product_id from product where user_id ='.$user_id;
$result=$conn->query($query);
$rows=$result->fetch_all(MYSQLI_NUM);
$COLID=array();
foreach($rows as $subarray1){
  foreach($subarray1 as $value){
    $COLID[]=$value;
  }
}
// var_dump($COLID);
if(!in_array($_SESSION['product_id_for_image'],$COLID)){
  echo"這個貨號不存在，請輸入有效的貨號<br>";
  $redirect='html_showallproduct_template.php';
  require_once ("test_header.php");
}
if($conn->connect_error){
  echo "無法連接數據庫，$databasename ， 回到login畫面","<br>";
  require_once ('test_header.php');
  exit();
}

$query = "select * from product 
            where user_id = ? and product_id = ?";
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
$product_id=$_SESSION['product_id_for_image'];
$stmt->bind_param('ii',$user_id,$product_id);
if(!$stmt->execute()){
  echo "尋找對應用戶號失敗， 回到选择頁面","<br>";
  header("refresh:2;url=http://localhost:8012/laravelFolder/resources/views/leanewentry.php");
  exit();
}
$result_stmt=$stmt->get_result();
while($row=$result_stmt->fetch_assoc()){
  echo "
    <head>
    <style>
    table.float_left{
      float:left;
    }
    span.clear_float{
      clear:both;
    }
    </style>
    <script id='jquery' src='jquery-3.4.1.js'></script>
    <!-- ripple effect library -->
    <script src='jquery.ripples.js'></script>
    <script id='bootstrap_js' src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script>
    <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
    <script id='jquery_cookie' src='/jquery-cookie-master/src/jquery.cookie.js'></script>
    <script id='vue' src='vue.min.js'></script>
    <link id='bootstrap' type='text/css' rel='stylesheet' href='/bootstrap-4.4.1-dist/css/bootstrap.min.css'>
    </head>
    <body> 
    <table><tr><th>貨號  </th><th>進貨地點</th><th>貨品簡介</th><th>貨品詳細</th></tr>
    <tr>
    <th>$row[product_id]</th>
    <th>$row[buy_place]</th>
    <th>$row[product_info]</th>
    <th>$row[product_detail]</th>
    </tr>
    </table>
  "
}
echo "<form id='form_for_delete' action ='html_deleteimage_template.php' method = 'post'>";
for($i=0;$i<$image_number_of_this_product;$i++){
  echo "<table class='float_left'>";
  echo " <tr ><th>圖片編號 $all_image_id_of_this_product[$i]</th></tr>";
  echo "<td><img height='80' width='80 'src='data:image/jpeg;base64,"
  .base64_encode($all_image_data_of_this_product[$i])."'/></td></<td>";
  echo " <tr ><td><input type='submit' name='$all_image_id_of_this_product[$i]' value='刪除圖片'></td></tr>";

echo "</table>";
}
echo "</form>";
echo "<span class='clear_float'></span>";
echo "  <br><br><br><br><br><br><br>";


echo "最左邊的圖片會作為縮略圖在 市場中顯示。";
if($image_number_of_this_product>=6){
  echo "<h3>已經到達上傳圖片的數量限制，請刪除一些圖片</h3>";
}elseif($image_number_of_this_product<6){
  echo "<h4>您已經為這個貨號上傳了 $image_number_of_this_product 張圖片，請不要超過6張。</h4>";
  echo <<<_HEREDOC
  <form method="post" action="html_submitredirect_template.php" enctype='multipart/form-data'>
  <label>請選擇上傳圖片，格式為jpg或png，每張20mb以下，解析度小於3000*3000</label><br>
  <input type="hidden" name="date_image"  value='' >
  <input type="hidden" name='product_id_for_image' value=$product_id>
  <input type='file' name='image_data' required><br>
  <label>照片描述（選填）在market上顯示</label><br>
  <textarea name='image_info' maxlength='255' rows='4' cols='40' value=''></textarea><br>
  <input type="submit" name='image_data' value="上傳這張圖片。">
  </form>



_HEREDOC;
}echo '
<!--用於刪除session 中的 product_id_for_image-->
<form action="html_showallproduct_template.php" method="post">
<input type="submit" value="回到所有貨號頁面" 
name="unset_product_id_for_image">
</form>';


?>
  <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
  <script id='js' defer async type=text/javascript src="html_showallproduct_template.js"></script>
</body>
