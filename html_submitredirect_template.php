<?php
$URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
session_start();
if(isset($_POST) && $_POST != false){
  var_dump($_POST);
  echo "post <br>";
}
if(isset($_COOKIE) && $_COOKIE != false){
  var_dump($_COOKIE);
  echo 'cookie <br>';
}
if(isset($_SESSION)  && $_SESSION != false){
  var_dump($_SESSION);
  echo 'session <br>';
}

# 對應html_newpurchase.php的submit 一共22 line
if(isset($_POST['date_purchase'])&&isset($_POST['purchase_cost'])&&isset($_POST['purchase_number'])){
  require_once('login.php');
  $query='insert into purchase values(?,?,?,?,?,?,?)';
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error."||new purchase query 有問題");
  $product_id=$_SESSION['product_id_for_purchase'];
  $purchase_id=null;
  // var_dump($_POST['date_purchase']);
  # 修改为 database datetime的适合的格式；
  // var_dump($date_purchase);
  if(isset($_POST['date_purchase'])&&$_POST['date_purchase']==null){
    date_default_timezone_set('Asia/Shanghai');
    $current_time=date('Y-m-d H:i:s');
    $_POST['date_purchase']=$current_time;
    // echo "<div>var_dump($_POST[date_purchase]) null</div>";
  }else{
    if(isset($_POST['time_sold'])&&$_POST['time_sold']!=null){
      $_POST['date_purchase']=$_POST['date_purchase']." ".$_POST['time_sold'].":00";
    }else{
      date_default_timezone_set('Asia/Shanghai');
      $current_time=date('Y-m-d H:i:s');
      $_POST['date_purchase']=$current_time;
    // echo "<div>var_dump($_POST[date_purchase]) notnull</div>";
    }
  // echo "<div>$_POST[date_purchase]</div>";
  // echo var_dump($_POST['date_purchase']);
  }
  // echo var_dump($_POST['date_purchase']);
  $date_purchase = $_POST['date_purchase'];
  $purchase_cost=double_check_input($conn,$_POST['purchase_cost']);
  $purchase_number=double_check_input($conn,$_POST['purchase_number']);
  $purchase_size=double_check_input($conn,$_POST['purchase_size']);
  if($purchase_size!='XXXS'||$purchase_size!='XXS'||$purchase_size!='XS'||$purchase_size!='S'||$purchase_size!='M'||$purchase_size!='L'||$purchase_size!='XL'||$purchase_size!='XXL'){
    $purchase_size=null;
  }
  $user_id=$_SESSION['user_id'];
  $stmt->bind_param('iisiisi',$product_id,$purchase_id,$date_purchase,$purchase_cost,$purchase_number,$purchase_size,$user_id);
  if(!$stmt->execute()){
    echo "bind_param格式有问题，回到选择画面";
    if(strpos($URL,'herokuapp.com')!=false){
      header("refresh:2;url=https://bombmanbombman-project1.herokuapp.com/html_showallproduct_template.php");
    }else{
      header("refresh:2;url=http://localhost/html_showallproduct_template.php");
    }
    exit();
  }
  header('location:html_newpurchase_template.php');
}

#對應html_newsale.php的submit 一共24 line
if(isset($_POST['date_sold'])&&isset($_POST['price'])&&isset($_POST['customer_info'])&&isset($_POST['sold_size'])){
  require_once('login.php');
  $query='insert into sale values(?,?,?,?,?,?,?)';
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $product_id=$_SESSION['product_id_for_sale'];
  $sale_id=null;
  // var_dump($_POST['date_sold']);
  # 修改为 database datetime的适合的格式；
  // var_dump($date_sold);
  if(isset($_POST['date_sold'])&&$_POST['date_sold']==null){
    date_default_timezone_set('Asia/Shanghai');
    $current_time=date('Y-m-d H:i:s');
    $_POST['date_sold']=$current_time;
    // echo "<div>var_dump($_POST[date_sold]) null</div>";
  }elseif(isset($_POST['date_sold'])&&$_POST['date_sold']!=null){
    if(isset($_POST['time_sold'])&&$_POST['time_sold']!=null){
      $_POST['date_sold']=$_POST['date_sold']." ".$_POST['time_sold'].":00";
    }
    if(isset($_POST['time_sold'])&&$_POST['time_sold']==null){
      date_default_timezone_set('Asia/Shanghai');
      $current_time=date('Y-m-d H:i:s');
      $_POST['date_sold']=$current_time;
    // echo "<div>var_dump($_POST[date_sold]) notnull</div>";
    }
    if(!isset($_POST["time_sold"])){

    }
  // echo "<div>$_POST[date_sold]</div>";
  // echo var_dump($_POST['date_sold']);
  }
  $date_sold =$_POST['date_sold'];
  $price=double_check_input($conn,$_POST['price']);
  $customer_info=double_check_input($conn,$_POST['customer_info']);
  $user_id=$_SESSION['user_id'];
  $sold_size=double_check_input($conn,$_POST['sold_size']);
  if($sold_size!='XXXS'||$sold_size!='XXS'||$sold_size!='XS'||$sold_size!='S'||$sold_size!='M'||$sold_size!='L'||$sold_size!='XL'||$sold_size!='XXL'){
    $sold_size='';
  }
  $stmt->bind_param('iisisis',$product_id,$sale_id,$date_sold,$price,$customer_info,$user_id,$sold_size);
  if(!$stmt->execute()){
    echo "插入数据有问题，回到选择画面";
    if(strpos($URL,'herokuapp.com')){
      header("refresh:2;url=https://bombmanbombman-project1.herokuapp.com/html_newentry_template.php");
    }else{
      header("refresh:2;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_newentry_template.php");
    }
    exit();
  }
  header('location:html_newsale_template.php');
}

#對應html_marketimage.php的submit 
if(isset($_POST['image_data'])){
  #下面是一系列 檢查圖片格式的code
  if(!isset($_FILES)){
    echo '上傳失敗<br>';
    $redirect='html_showallproduct_template.php';
    unset($_SESSION['product_id_for_image']);
    require_once('test_header.php');
  }
  #檢驗圖片格式 共62 line
  if(isset($_FILES['image_data'])){
    // Get Image Dimension
    $fileinfo = @getimagesize($_FILES["image_data"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    $allowed_image_extension = array(
      "png",
      "jpg",
      "jpeg"
    );
    // Get image file extension
    $file_extension = pathinfo($_FILES["image_data"]["name"], PATHINFO_EXTENSION);
    // Validate file input to check if is not empty
    if (! file_exists($_FILES["image_data"]["tmp_name"])) {
      $response = array(
        "type" => "error",
        "message" => "剛剛的文件為空文件，請再試一次."
      );
    }    
    // Validate file input to check if is with valid extension
    if (! in_array($file_extension, $allowed_image_extension)) {
      $response = array(
        "type" => "error",
        "message" => "文件格式不對，只允許PNG,JPEG格式的圖片。" 
      );
    }    
    // Validate image file size
    //記得要在php.ini中 設置 upload_max_filesize，post_max_size，默認只有8mb；
    if (($_FILES["image_data"]["size"] > 20000000)) {
      $response = array(
        "type" => "error",
        "message" => "圖片文件太大，只允許20MB以下。"
      );
    }    
    // Validate image file dimension
    if ($width > "3024" || $height > "3024") {
      $response = array(
        "type" => "error",
        "message" => "圖片的解析度太高，請上傳小於3000*3000的圖片"
      );
    } 
    // else {
        // $target = "image/" . basename($_FILES["image_data"]["name"]);
        // if (move_uploaded_file($_FILES["image_data"]["tmp_name"], $target)) {
            // $response = array(
                // "type" => "success",
                // "message" => "圖片保存到服務器的文件夾中."
            // );
        // } else {
            // $response = array(
                // "type" => "error",
                // "message" => "出現了未知的原因."
            // );
        // }
    // }
    if(isset($response['message'])){
      print_r( $response['message']);
      echo"<br>請重新在上傳<br>";
      if(strpos($URL,'herokuapp.com')){
        header("refresh:3;url=https://bombmanbombman-project1.herokuapp.com/html_marketimage_template.php");
      }else{
      header("refresh:3;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_marketimage_template.php");
      }
      exit();
    }
  }
  require_once("login.php");
  if(isset($_POST['date_image'])&&isset($_FILES['image_data'])&&isset($_POST['product_id_for_image'])){
    var_dump($_FILES['image_data']);
    $query='insert into image values(?,?,?,?,?,?,?)';
    $stmt=$conn->prepare($query);
    if(!$stmt)echo($conn->error);
    $product_id=$_SESSION['product_id_for_image'];
    $image_id=null;
    date_default_timezone_set('Asia/Shanghai');
    $date_image=date('Y-m-d H:i:s');
    $image_info=double_check_input($conn,$_POST['image_info']);
    $null=null;
    echo"<br>";
    $image_data=file_get_contents($_FILES['image_data']['tmp_name']);
    $image_type=getimagesize($_FILES['image_data']['tmp_name']);
    $image_type=$image_type['mime'];
    $user_id=$_SESSION['user_id'];
    $stmt->bind_param('iissbsi',$product_id,$image_id,$date_image,$image_info,$null,$image_type,$user_id);
    $stmt->send_long_data(4,$image_data);
    if(!$stmt->execute()){
      echo "插入数据有问题，回到选择画面";
      if(strpos($URL,'herokuapp.com')){
        header("refresh:2;url=https://bombmanbombman-project1.herokuapp.com/html_marketimage_template.php");
      }else{
        header("refresh:2;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_marketimage_template.php");
      }
      exit();
    }
    $conn->close();
    #終結 end
    header('location:html_marketimage_template.php');
  }
}























?>