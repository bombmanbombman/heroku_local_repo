<?php  //保存為login.php
  $host="localhost";
  $username="root";
  $password="";
  $databasename="project1";
  $conn = new mysqli($host,$username,$password,$databasename);
  if($conn->connect_error){
    echo "<div><span id='echo1'>無法連接數據庫，</span>$databasename<span id='echo2'></span></div>";
    $redirect='html_login_template.php';
    require_once ('test_header.php');
    exit();
  }
  //set mysql的文字集 character set
  if(!$conn->set_charset("utf8mb4")){
    printf('error loading character: %s',$conn->error);
    exit();
  }else{
    if($conn->character_set_name() != 'utf8mb4'){
      printf('current character set : %s',$conn->character_set_name());
    }
  }
  $conn->query("SET NAMES utf8mb4 COLLATE  utf8mb4_general_ci");
  /** 設定各種character 避免亂碼 文字化け　grable*/
  // $conn->query("SET character_set_results = utf8mb4");
  // $conn->query("SET character_set_database = utf8mb4");
  // $conn->query("SET character_set_client = utf8mb4");
  // $conn->query("SET character_set_connection = utf8mb4");
  // $conn->query("SET character_set_server = utf8mb4");
  


/*用 mysqli中的method  mysqli->real_escape_string(string$input)來過濾 
*<form method='post'></form>中的user input http injection
*  htmlentities 要與 real_escape_string(string$inputname)一起使用
* 注意，htmalspecialchars 為使html中的query result正確顯示。
*/
function double_check_input($conn,$userinput){
  //包含了下面2個function的內容，可以用於所有user的input。
  anti_sql_injection_post($conn,$userinput);
  $userinput=check_string_input($userinput);
  return $userinput;
}
function anti_sql_injection_post($conn, $userinput) {
  //arg2 :$userinput 用於檢查 <form></form> 中的user input 並且進行 encode 防止sql injection.
  if(get_magic_quotes_gpc()) $userinput = stripcslashes($userinput);
  return $conn->real_escape_string($userinput);
  }
function check_string_input($userinput){
  //用於檢查 user 的 各種 input，不一定用於 mysql，包含防止javascript injection
  if(get_magic_quotes_gpc())
  $userinput = stripcslashes($userinput);
  $userinput = strip_tags($userinput);
  $userinput=htmlentities($userinput);
  return $userinput;
}
//用於檢測string datatype是否不是 blob base64的value；如果不是 return true 是return false
function is_base64($string){
  return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string);
}
#將 rows=$result_stmt->fetch_all() 的兩次元array變為1次元的associative array。
/**
 * rows=array(
 *            [0]=>array(
 *                       key11=>value11;
 *                 )
 *            [1]=>array(
 *                       key12=>value12;
 *                 )
 * )
 */
function change_2_dimension_order_array_to_one_associative_array($arrayname){
  $COLID=array();
  foreach($arrayname as $key0=>$subarray1){
    foreach($subarray1 as $key1=>$value1){
      $COLID[]=$value1;
    }
  }
  return $COLID;
}
#用於檢測 這個user_id是否有 輸入 product_id,||是否存在product table
function check_product_table_exist($conn,$user_id){
  $query ='select product_id from product 
            where user_id ='.$user_id;
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $stmt->execute();
  $result_stmt=$stmt->get_result();
  $num_rows=$result_stmt->num_rows;
  // var_dump($num_rows===0);
  // echo '<br>';
  if($num_rows===0){
    echo "<br><br><div id='echo3'>您還沒有輸入任何的貨品數據，10秒後自動回到用戶頁面。</div>";
    $wait_time=10;
    require_once ('test_header.php');
    $conn->close();
    exit();
  }
}
# fetch product table中的整個COLID product_id；
function fetch_product_id($conn,$user_id){
  $query ='select product_id from product 
            where user_id ='.$user_id;
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $stmt->execute();
  $result_stmt=$stmt->get_result();
  $num_rows=$result_stmt->num_rows;
  // var_dump($num_rows===0);
  // echo '<br>';
  if($num_rows===0){
    echo "<br><br><div id='echo4'>您還沒有輸入任何的貨品數據，10秒後自動回到用戶頁面。</div>";
    $wait_time=10;
    require_once ('test_header.php');
    $conn->close();
    exit();
  }
  $all_product_id=array();
  while($row=$result_stmt->fetch_assoc()){
    // $all_product_id[$row['product_id']]=$row;
    $all_product_id[]=$row;
    // var_dump($row);
  }
  echo "<table><tr><th><span id='echo5'>貨號</span></th></tr>";
  foreach($all_product_id as $key0 => $subarray1){
    echo "<tr><th>";
    foreach($subarray1 as $key1 => $value1){
      echo "$value1";
    }
    echo "</th></tr>";
  }
  echo "</table>";
}
#fetch 一整個product table
function fetch_product_table($conn,$user_id,$offset='',$order='asc',$show_col_num='20'){
  $query ='select product_id,buy_place,product_info,product_detail from product 
  where user_id = '.$user_id 
  .' order by product_id '.$order
  .' limit '.$offset.$show_col_num;
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $stmt->execute();
  if(!$stmt)die('select query failed');
  // var_dump($stmt);
  $result_stmt=$stmt->get_result();
  // var_dump($result_stmt);
  $product_table=array();
  while($row=$result_stmt->fetch_assoc()){
  // $all_product_id[$row['product_id']]=$row;
  $product_table[]=$row;
  }
  echo "<table><tr><th><span id='echo6'>貨號</span></th><th><span id='echo7'>購買地址</span></th><th><span id='echo8'>貨品簡介</span></th><th><span id='echo9'>貨品詳細</span></th></tr>";
  foreach($product_table as $key0 => $subarray1){
    echo "<tr>";
    foreach($subarray1 as $key1 => $value1){
      echo "<th>".$value1."</th>";
    }
    echo "</tr>";
  }
  echo "</table>";
}
#fetch product pruchase 中 需要顯示的部分，用inner join 
function fetch_product_purchase_table($conn,$user_id){
  $query = 
  "select product.product_id,buy_place,product_info, 
  purchase.date_purchase,purchase_cost,purchase_number,purchase_size
    from purchase
    inner join product 
    on product.product_id = purchase.product_id
    where product.user_id=".$user_id;
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  if(!$stmt->execute())die(error_report($conn,$query));
  $result_stmt=$stmt->get_result();
  $product_purchase_table=array();
  while($rows=$result_stmt->fetch_assoc()){
    $product_purchase_table[]=$rows;
  }
  echo "<table><tr><th><span id='echo10'>貨號</span></th><th><span id='echo11'>購買地址</span></th><th><span id='echo12'>貨品簡介</span></th>
  <th><span id='echo13'>進貨日期</span></th><th><span id='echo14'>進貨價格（元）</span></th><th><span id='echo15'>進貨件數</span></th><th><span id='echo16'>商品尺寸</span></th><th></tr>";
  foreach($product_purchase_table as $key0 => $subarray1){
    echo "<tr>";
    foreach($subarray1 as $key1 => $value1){
      echo "<th>".$value1."</th>";
    }
    echo "</tr>";
  }
  echo "</table>";
}





# mysqli 的 error report
$mysqli_driver=new mysqli_driver;
$mysqli_driver->report_mode = MYSQLI_REPORT_STRICT;
function error_report($conn,$query){
  global $mysqli_driver;
  try{
    $result=$conn->query($query);
    if(!is_bool($result))$result->close();
    $conn->close();
  }catch(mysqli_sql_exception $e){
    echo $e->__toString();
    exit();
  }
}
?>