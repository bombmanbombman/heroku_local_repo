<?php
session_start();
var_dump($_SESSION);
require_once("html_navibar_template.php");
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='https://bombmanbombman-project1.herokuapp.com/#';
  require_once ('test_header.php');
  exit();
}
require_once("login.php");
$user_id=$_SESSION['user_id'];
#僅僅對 showallproduct.php頁面 搜索而來的進行filter.
if(isset($_POST['product_id_for_purchase'])&&$_POST['product_id_for_purchase']!=0){
  $_SESSION['product_id_for_purchase']=$_POST['product_id_for_purchase'];
}
echo "<br><br><br>";
#尋找product_id_for_purchase是否存在product table中 一共15行。
$query ='select product_id from product where user_id ='.$user_id;
$result=$conn->query($query);
$rows=$result->fetch_all(MYSQLI_NUM);
$all_product_id_in_product=array();
foreach($rows as $subarray1){
  foreach($subarray1 as $value){
    $all_product_id_in_product[]=$value;
  }
}
// var_dump($all_product_id_in_product);
if(!in_array($_SESSION['product_id_for_purchase'],$all_product_id_in_product)){
  echo"這個貨號不存在，請輸入有效的貨號<br>";
  unset($_SESSION['product_id_for_purchase']);
  $redirect='html_showallproduct_template.php';
  require_once ("test_header.php");
}
#顯示這個貨品的product table中的內容 一共 15 line
$query='select product_id,buy_place,product_info,product_detail from product 
  where user_id = '.$user_id.' and product_id = '.$_SESSION['product_id_for_purchase'];
$stmt=$conn->query($query);
if(!$stmt)echo($conn->error);
echo "<table><tr><th>貨號</th><th>進貨地點</th><th>貨品簡介</th><th>貨品詳細</th></tr>";
while($row=$stmt->fetch_assoc()){
  echo<<<_HEREDOC
  <tr>
    <td>$row[product_id]</td>
    <td>$row[buy_place]</td>
    <td>$row[product_info]</td>
    <td>$row[product_detail]</td>
  </tr>
_HEREDOC;
}
echo "</table>";
#尋找product_id_for_purchase是否也存在與purchase table中  一共18行 
$query ='select product_id from purchase 
  where user_id ='.$user_id;
$stmt=$conn->query($query);
if(!$stmt)echo($conn->error);
$rows=$stmt->fetch_all(MYSQLI_NUM);
$all_product_id_in_purchase=array();
foreach($rows as $subarray1){
  foreach($subarray1 as $value){
    $all_product_id_in_purchase[]=$value;
  }
}
// var_dump($all_product_id_in_purchase);
if(in_array($_SESSION['product_id_for_purchase'],$all_product_id_in_purchase)){
  echo"已經對這個貨號進過貨。<br>";
  $progress1=true;
}else{
  echo "還沒有對這個貨號進過貨<br>";
}
#尋找product_id_for_purchase是否也存在與sale table中  一共18行 
$query ='select product_id from sale 
  where user_id ='.$user_id;
$stmt=$conn->query($query);
if(!$stmt)echo($conn->error);
$rows=$stmt->fetch_all(MYSQLI_NUM);
$all_product_id_in_sale=array();
foreach($rows as $subarray1){
  foreach($subarray1 as $value){
    $all_product_id_in_sale[]=$value;
  }
}
// var_dump($all_product_id_in_sale);
if(in_array($_SESSION['product_id_for_purchase'],$all_product_id_in_sale)){
  echo"這個貨號有出售記錄。<br>";
  $progress2=true;
}else{
  echo "這個貨號還沒有成交過。<br>";
}

#如果已經進過貨，那麼顯示更詳細的內容 顯示最近期的10筆購入記錄  26 line
if(isset($progress1)&&$progress1===true){
  $product_id=$_SESSION['product_id_for_purchase'];
  $query = 'select b.purchase_id,
  b.date_purchase,b.purchase_cost,b.purchase_number,purchase_size 
  from product a 
  inner join purchase b on(a.product_id = b.product_id) 
  where a.user_id = '.$user_id.' and a.product_id = '.$product_id.
  ' order by b.date_purchase desc 
  limit 10';
  $stmt=$conn->query($query);
  if(!$stmt)echo($conn->error);
  echo "<br>
  <label>進貨記錄，僅僅顯示最近的10筆</label><br>
  <table><tr><th>進貨編號</th>
  <th>進貨日期</th><th>進貨價格</th><th>進貨數量</th><th>進貨尺碼</th></tr>";
  while($row=$stmt->fetch_assoc()){
    echo <<<_HEREDOC
    <tr>
    <th>$row[purchase_id]</th>
    <th>$row[date_purchase]</th>
    <th>$row[purchase_cost]</th>
    <th>$row[purchase_number]</th>
    <th>$row[purchase_size]</th>
    </tr>
_HEREDOC;
  }
  #如果已經出售過，顯示最近10筆交易記錄   27 line
  echo "</table>";
  if(isset($progress2)&&$progress2===true){
    $query = 'select b.sale_id,
    b.date_sold,b.price,b.customer_info,b.sold_size 
    from product a 
    inner join sale b on(a.product_id = b.product_id) 
    where a.user_id = '.$user_id.' and a.product_id = '.$product_id.
    ' order by b.date_sold desc 
    limit 10';
    $stmt=$conn->query($query);
    if(!$stmt)echo($conn->error);
    echo "<br>
    <label>出售記錄，僅僅顯示最近的10筆</label><br>
    <table><tr><th>出售編號</th>
    <th>出售日期</th><th>出售價格</th><th>客戶描述</th><th>售出尺碼</th></tr>";
    while($row=$stmt->fetch_assoc()){
      echo <<<_HEREDOC
      <tr>
      <th>$row[sale_id]</th>
      <th>$row[date_sold]</th>
      <th>$row[price]</th>
      <th>$row[customer_info]</th>
      <th>$row[sold_size]</th>
      </tr>
_HEREDOC;
    }
    echo "</table>";
  }
}

echo <<<_HEREDOC
<br>
<br>
<br>

<form method="post" action="html_submitredirect_template.php">
<label>進貨的具體時間,如果為空，自動載入當前時間</label><br>
<input type="datetime-local" name="date_purchase" size="40" value=''><br>
<label>一件的入貨價格</label><br>
<input type="number" name="purchase_cost" min='1' max="99999999" size="40" required>元/件<br>
<label>這個商品入貨了幾件</label><br>
<input type="number" name="purchase_number" min='1' max="99999999" size="40" required>件<br>
<input type="hidden" name='product_id_for_purchase' value='0'>
<label>尺碼（選填）</label>
<select name='purchase_size'>
<option value='未填寫'>請選擇</option>
<option value='XXXS'>XXXS</option>
<option value='XXS'>XXS</option>
<option value='XS'>XS</option>
<option value='S'>S</option>
<option value='M'>M</option>
<option value='L'>L</option>
<option value='XL'>XL</option>
<option value='XXL'>XXL</option>
</select><br><br><br>
<input type="submit" value="記錄這次的進貨数据。">
</form><br><br>
<!--用於刪除session 中的 product_id_for_purchase-->
<form action="html_showallproduct_template.php" method="post">
  <input type="submit" value="回到所有貨號頁面" 
  name="unset_product_id_for_purchase">
</form>

_HEREDOC;

?>