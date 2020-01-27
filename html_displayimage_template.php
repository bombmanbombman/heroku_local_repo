<html>
<head>
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
<?php
$URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
if(strpos($URL,'herokuapp.com')){
  echo "<div>$URL</div>";
}else{
  echo "<div>$URL</div>";
}
if(isset($_POST) && $_POST != false){
  var_dump($_POST);
  echo "post <br>";
}
if(isset($_COOKIE) && $_COOKIE != false){
  var_dump($_COOKIE);
  echo 'cookie <br>';
}
session_start();
if(isset($_SESSION)){
  var_dump($_SESSION);
  echo 'session <br>';
}
require_once("html_navibar_template.php");
require_once ('login.php');
if(!isset($_SESSION['user_id'])){
  echo "<div id='echo1'>session 傳送失敗</div>";
  $redirect='index.php';
  $conn->close();
  require_once ('test_header.php');
  exit();
}
$query = "select product_id,image_id,date_image,image_info,image_data,image_type from image
            where user_id = ?";
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
$user_id=$_SESSION['user_id'];
$stmt->bind_param('i',$user_id);
if(!$stmt->execute()){
  echo "<div id='echo2'>query 執行錯誤</div>";
  $redirect='html_showallproduct_template.php';
  $conn->close();
  require_once ('test_header.php');
  exit();
}
$result_stmt=$stmt->get_result();
echo "<br><br><br>";
echo "<h1 id='echo3'>點擊小圖，可以查看原圖大小</h1>";
echo "<table><tr><th><span id='echo4'>對應貨號</span></th><th><span id='echo5'>圖片編號</span></th><th><span id='echo6'>上傳時間</span></th><th><span id='echo7'>圖片說明</span></th><th><span id='echo8'>圖片類型</span></th></tr>";
while($row=$result_stmt->fetch_assoc()){
  echo "<tr>";
  echo "<th>".$row['product_id']."</th>";
  echo "<th>".$row['image_id']."</th>";
  echo "<th>".$row['date_image']."</th>";
  echo "<th>".$row['image_info']."</th>";
  echo "<th>".$row['image_type']."</th>";
  echo "</tr>";
  $image_id=$row['image_id'];
  # 要想用 anchor tag <a></a> pass value 用來顯示原圖
  echo "<a target='_blank' rel='noopener noreferrer' href='html_originalimage_template.php?image_id=",urlencode($image_id),"'><img height='80' width='80 'src='data:image/jpeg;base64,".base64_encode($row["image_data"])."'/></a>";

}
echo "</table>";
echo "<button><a href='html_showallproduct_template.php'><span id='echo9'>回到全貨號頁面</span></a></button>";
$conn->close();


?>
<script id='ref' defer async type='text/javascript' src='html_template.js'></script>
<script id='js' defer async type=text/javascript src='html_displayimage_template.js'></script>
</body>
</html>