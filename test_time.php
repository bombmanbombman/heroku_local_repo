<?php
if(isset($_POST)){
  var_dump($_POST);
  echo '<br>';
}
if(isset($_POST['date_purchase'])&&$_POST['date_purchase']==null){
  date_default_timezone_set('Asia/Shanghai');
  $current_time=date('Y-m-d H:i:s');
  $_POST['date_purchase']=$current_time;
  
  var_dump($_POST['date_purchase']);
  echo "<br>";
}else{
  $_POST['date_purchase']=str_replace('T',' ',$_POST['date_purchase']).':00';
  var_dump($_POST['date_purchase']);
  echo "<br>";
}
date_default_timezone_set('Asia/Shanghai');
$current_time=date('Y-m-d H:i:s');
// var_dump($current_time);
echo '<br>';
echo <<<_HEREDOC
<form method="post" action="">
<label>進貨的具體時間</label><br>
<input type="datetime-local" name="date_purchase" size="40" value='$current_time' ><br>
<label>一件的入貨價格</label><br>
<input type="number" name="purchase_cost" min='1' max="99999999" size="40" >元/件<br>
<label>這個商品入貨了幾件</label><br>
<input type="number" name="purchase_number" min='1' max="99999999" size="40" >件<br>
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