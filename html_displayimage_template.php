<?php
session_start();
var_dump($_SESSION);
require_once("html_navibar_template.php");
require_once ('login.php');
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
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
if(!$stmt->execute())die('query 執行錯誤');
$result_stmt=$stmt->get_result();
echo "<br><br><br>";
echo "<h1>點擊小圖，可以查看原圖大小</h1>";
echo "<table><tr><th>對應貨號</th><th>圖片編號</th><th>上傳時間</th><th>圖片說明</th><th>圖片類型</th></tr>";
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
echo "<a href='html_showallproduct_template.php'>回到全貨號頁面</a>";
$conn->close();
























?>