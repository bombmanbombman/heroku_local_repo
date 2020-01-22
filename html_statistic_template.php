<?php
session_start();
var_dump($_SESSION);
echo '<br>';
require_once("html_navibar_template.php");
if(!isset($_SESSION['user_id'])){
  echo "session 傳送失敗<br>";
  $redirect='https://bombmanbombman-project1.herokuapp.com/#';
  require_once ('test_header.php');
  exit();
}
$user_id=$_SESSION['user_id'];
require_once('login.php');
#計算user_id 所持有的 product_id個數,用於檢驗是否可以顯示所有table。index=>product_id
#可以用$i++ 來一一對應 一共 17 line
$query = 'select product_id from product where user_id = '.$user_id;
$stmt=$conn->query($query);
if(!$stmt)echo($conn->error);
$rows=$stmt->fetch_all();
// var_dump($rows);
$product_id_array=array();
foreach($rows as $key0 => $subarray1){
  foreach($subarray1 as $key1 => $value1){
    $product_id_array[]=$value1;
  }
}
// var_dump($product_id_array);
echo "<br><br>";
$num_rows=count($product_id_array);
if($num_rows==0){
  echo '您還沒有添加任何的貨號，請先回到用戶頁面添加新的貨號';
  $conn->close();
}

#記錄每一個 product_id對應的 最新的一個purchase_id,並將其變為一個 array key=》value pair element 一共13行。
$date_purchase_array=array();
$purchase_cost_array=array();
foreach($product_id_array as $value){
  $query = 'select date_purchase,purchase_cost from purchase 
    where product_id ='.$value.' and user_id = '.$user_id.
    ' order by date_purchase desc 
    limit 1';
  $stmt=$conn->query($query);
  if(!$stmt)echo($conn->error);
  $row=$stmt->fetch_assoc();
  // echo "$value => $row <br>";
  $date_purchase_array[$value]=$row['date_purchase'];
  $purchase_cost_array[$value]=$row['purchase_cost'];
}
// var_dump($date_purchase_array);

#記錄每一個 product_id對應的 最新的一個sale_id,並將其變為一個 array key=》value pair element 一共13行。
$date_sold_array=array();
$price_array=array();
foreach($product_id_array as $value){
  $query = 'select date_sold,price from sale 
    where product_id ='.$value.' and user_id = '.$user_id.
    ' order by date_sold desc 
    limit 1';
  $stmt=$conn->query($query);
  if(!$stmt)echo($conn->error);
  $row=$stmt->fetch_assoc();
  // echo "$value => $row <br>";
  $date_sold_array[$value]=$row['date_sold'];
  $price_array[$value]=$row['price'];
}
// var_dump($date_sold_array);

#計算庫存的指數 product_id_purchase_id進貨總和 - 該product_id對應的count(purchase_id) 一共11 line
$remain_product_number=array();
foreach($product_id_array as $value){
  $query = "select a - b from
  (select sum(purchase_number) as a from purchase where product_id=".$value.") as c 
  inner join (select count(sale_id) as b from sale where product_id =".$value.") as d";
  $stmt=$conn->query($query);
  if(!$stmt)echo($conn->error);
  $row=$stmt->fetch_assoc()['a - b'];
  // echo "$value => $row <br>";
  $remain_product_number[$value]=$row;
}
// var_dump($remain_product_number);

#计算 sale table 中 关于 一个 product_id 对应的 sale_id 個數 一共 10 line
// $total_sale_number_of_product_id=array();
// foreach($product_id_array as $value){
//   $query = "select count(sale_id) from sale 
//     where product_id in (".$value.")";
//   $stmt=$conn->query($query);
//   if(!$stmt)echo($conn->error);
//   $row=$stmt->fetch_assoc()['count(sale_id)'];
//   echo "$value => $row <br>";
//   $total_sale_number_of_product_id[$value]=$row;
// }
// var_dump($total_sale_number_of_product_id);

// #計算user_id 所持有的 purchase_id,用於檢驗是否可以顯示所有table。一共17 line
// $query = 'select purchase_id from purchase where user_id = '.$user_id;
// $stmt=$conn->query($query);
// if(!$stmt)echo($conn->error);
// $rows=$stmt->fetch_all();
// // var_dump($rows);
// $purchase_id_array=array();
// foreach($rows as $key0 => $subarray1){
//   foreach($subarray1 as $key1 => $value1){
//     $purchase_id_array[]=$value1;
//   }
// }
// var_dump($purchase_id_array);
// $num_rows=count($purchase_id_array);
// if($num_rows==0){
//   echo '您還沒有添加任何的貨號，請先回到用戶頁面添加新的貨號';
//   $conn->close();
// }
// #計算user_id 所持有的 sale_id,用於檢驗是否可以顯示所有table。一共17 line
// $query = 'select sale_id from purchase where user_id = '.$user_id;
// $stmt=$conn->query($query);
// if(!$stmt)echo($conn->error);
// $rows=$stmt->fetch_all();
// // var_dump($rows);
// $purchase_id_array=array();
// foreach($rows as $key0 => $subarray1){
//   foreach($subarray1 as $key1 => $value1){
//     $purchase_id_array[]=$value1;
//   }
// }
// var_dump($purchase_id_array);
// $num_rows=count($purchase_id_array);
// if($num_rows==0){
//   echo '您還沒有添加任何的貨號，請先回到用戶頁面添加新的貨號';
//   $conn->close();
// }

#選擇除了庫存以外的所需COLID，庫存需要計算COUNT(COLID)， 一共33 line
// $query = "select a.product_id,a.product_info,
//   b.date_purchase,b.purchase_cost,
//   c.date_sold,c.price
//   from product a 
//     inner join purchase b on(a.product_id = b.product_id) 
//     inner join sale c on(a.product_id = c.product_id) 
//     where a.user_id = ? 
//     order by date_purchase desc,date_sold desc";
// $stmt=$conn->prepare($query);
// if(!$stmt)echo($conn->error);
// $stmt->bind_param('i',$user_id);
// if(!$stmt->execute()){
//   echo "尋找對應用戶號失敗， 回到选择頁面","<br>";
//   header("refresh:2;url=http://localhost:8012/laravelFolder/resources/views/leanewentry.php");
//   exit();
// }
// $result_stmt=$stmt->get_result();
// echo "<table><tr><th>貨號  </th><th>貨品簡介</th><th>最後進貨時間</th>
// <th>進價(元)</th><th>最後出售時間</th><th>售價</th><th>庫存</th></tr>";
// while($row=$result_stmt->fetch_assoc()){
//   echo <<<_HEREDOC
//   <tr>
//   <td>$row[product_id]</td>
//   <td>$row[product_info]</td>
//   <td>$row[date_purchase]</td>
//   <td>$row[purchase_cost]</td>
//   <td>$row[date_sold]</td>
//   <td>$row[price]</td>
//   </tr>
  
// _HEREDOC;
// }

#試驗 使用 $product_id_array ，$date_purchase_array,$purchase_cost_array,$date_sold_array,$price_array,$remain_product_number 一共 48 line
// var_dump($product_id_array);
echo "<br><table><tr><th>貨號</th><th>貨品簡介</th><th>最後進貨時間</th>
<th>進價(元)</th><th>最後出售時間</th><th>售價(元)</th><th>庫存</th></tr>";
foreach($product_id_array as $value){
  // var_dump($user_id);
  // var_dump($value);
  // var_dump($date_purchase_array[$value]);
  // var_dump($purchase_cost_array[$value]);
  // var_dump($date_sold_array[$value]);
  // var_dump($price_array[$value]);
  // var_dump($remain_product_number[$value]);
  $query = "select product_id,product_info from product 
    where user_id = ".$user_id." and product_id =".$value;
  $stmt=$conn->query($query);
  if(!$stmt)echo($conn->error);
  while($row=$stmt->fetch_assoc()){
    echo "<tr>";
    echo "<td>$row[product_id]</td>";
    echo "<td>$row[product_info]</td>";
    if($date_purchase_array[$value]==null){
      echo "<td>未入货</td>";
    }else{
      echo "<td>$date_purchase_array[$value]</td>";
    }
    if($purchase_cost_array[$value]==null){
      echo "<td>未入货</td>";
    }else{
      echo "<td>$purchase_cost_array[$value]</td>";
    }    
    if($date_sold_array[$value]==null){
      echo "<td>未售出</td>";
    }else{
      echo "<td>$date_sold_array[$value]</td>";
    }   
    if($price_array[$value]==null){
      echo "<td>未售出</td>";
    }else{
      echo "<td>$price_array[$value]</td>";
    }    
    if($remain_product_number[$value]!=null){
      echo "<td>$remain_product_number[$value]</td>";
    }
    if($remain_product_number[$value]==null&&$remain_product_number[$value]==0){
      echo "<td>0</td>";
    }
  }
    echo "</tr>";
}
  echo "</table>";



?>


