
<?php
require_once('2019pdoconnect.php');
session_start();
$submit='';
$msg = "";
var_dump($_POST);
var_dump($_FILES);
if (isset($_POST['upload'])){
  $conn = new neoPDO();
  $target = "images/".basename($_FILES['image']['name']);
  $image = $_FILES['image']['name'];
  $img_name = $_POST['img_name'];
  $query = $conn->prepare("INSERT INTO image (name, image) VALUES ('$img_name', '$image')");
  if(!$query)die('query 輸入格式錯誤');
  $query->execute();
  $fetch = $query->fetch();
  print_r($query);

// Now let's move the uploaded image into the folder: image
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
  $msg = "image upload successfully";

  }else{
  $msg = "There was a problem uploading image";
  }

}
echo <<<_HEREDOC
<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <title>PHP Form Upload</title>
  </head>
  <body> 
    <form method="post" action='$_SERVER[PHP_SELF]' 
    enctype='multipart/form-data'> 
    Select File: <input type='file' name='upload' size='10' id='upload'><br> 
    <input type='submit' name='submit' value='Upload Image'> 
    </form>
  </body>
</html>
_HEREDOC;

?>