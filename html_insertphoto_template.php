<?php
require_once ('html_navibar_template.php');

if(!isset($_FILES['image_data']))echo "<br><br><br>請選擇上傳圖片，最大6張<br>";
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
    header("refresh:3;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_insertphoto_template.php");
    exit();
  }
  require_once ('login.php');
  $conn=new mysqli($host,$username,$password,$databasename);
  if($conn->connect_error){echo(
    '<div>無法連接數據庫，請聯繫管理員</div>');
    require_once ("test_header.php");
  }  
  $query=('insert into image values(?,?,?,?,?,?)');
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $product_id=5;
  $image_id=0;
  $date_image=null;
  $image_info=null;
  $image_data=file_get_contents($_FILES['image_data']['tmp_name']);
  $image_type=getimagesize($_FILES['image_data']['tmp_name']);
  $image_type=$image_type['mime'];
  $null=null;
  $stmt->bind_param('iissbs',$product_id,$image_id,$date_image,$image_info,$null,$image_type);
  $stmt->send_long_data(4,$image_data);
  if(!$stmt->execute()){
    echo"<div>插入圖片失敗，請聯繫管理員</div>";
    require_once("test_header.php");
  }
    header('location:html_displayimage_template.php');
    exit();
}

echo <<<_HEREDOC
<form method='post' action='' enctype='multipart/form-data'>
<input type='file' name='image_data'>
<input class='btn btn-warning' type="submit" value='提交'>
_HEREDOC;





?>