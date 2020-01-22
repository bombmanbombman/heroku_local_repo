<?php
session_start();
// var_dump($_SESSION);
require_once('html_navibar_template.php');
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='https://bombmanbombman-project1.herokuapp.com/#';
  require_once ('test_header.php');
  exit();
}
if(isset($_SESSION['user_id'])&&isset($_POST['product_id_for_purchase'])){
  require_once('login.php');
  $user_id=$_SESSION['user_id'];
  $product_id=$_POST['product_id_for_purchase'];
  echo "<br><br><br>";
  var_dump($_SESSION);
  echo "<br>";
  $query = 'select * from purchase 
              where product_id ='.$product_id.' and user_id='.$user_id;
  $stmt=$conn->query($query);
  if(!$stmt)echo($conn->error);
  $purchase_rows=$stmt->num_rows;
  var_dump($purchase_rows);
  echo "<br>";
  $query1='select * from sale
            where product_id ='.$product_id.' and user_id='.$user_id;
  $stmt1=$conn->query($query1);
  if(!$stmt1)echo($conn->error);
  $sale_rows=$stmt1->num_rows;
  var_dump($sale_rows);
  echo "<br>";
  echo <<<_HEREDOC
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
  </head>
_HEREDOC;
  if($purchase_rows==0){
    echo "這個貨號還沒有進貨進貨記錄<br>";
    fetch_product_table($conn,$user_id);
    echo "<a href='html_newpurchase_template.php' class='button'><h2>添加新的進貨記錄</h2></a>";
    echo "<br><br><br>";
  }
  elseif($sale_rows==0&&$purchase_rows!=0){
    echo '這個還沒有出售記錄<br>';
    $purchase_id=array();
    while($rows=$stmt->fetch_assoc()){
      $purchase_id[]=$rows['purchase_id'];
    }
    var_dump($purchase_id);
    echo "<br>";
    $_SESSION['purchase_id']=$purchase_id;
    fetch_product_purchase_table($conn,$user_id);
    echo "<a href='html_secondpurchase_template.php' class='button'><h2>添加新的進貨記錄</h2></a>";
    echo"<br><br><br>";
    echo "<a href='html_newsale_template.php' class='button'><h2>添加新的出售記錄</h2></a>";
    echo "<br><br><br>";
  }
  // elseif(!$purchase_rows!=0&&!$sale_rows!=0){
  //   echo "要跳轉至secondpurchase與secondsale";
  //   $purchase_id=array();
  //   while($rows=$stmt->fetch_assoc()){
  //     $purchase_id[]=$rows['purchase_id'];
  //   }
  //   var_dump($purchase_id);
  //   echo "<br>";
  //   $_SESSION['purchase_id']=$purchase_id;
  //   fetch_product_purchase_sale_table($conn,$user_id);
  //   echo "<a href='html_secondpurchase_template.php' class='button'><h2>添加新的進貨記錄</h2></a>";
  //   echo"<br><br><br>";
  //   echo "<a href='html_secondsale_template.php' class='button'><h2>添加新的出售記錄</h2></a>";
  //   echo "<br><br><br>";
  // }
  echo "<a href='html_marketimage_template.php' class='button'><h2>添加圖片</h2></a>";
}




























?>