<?php
require_once ('html_navibar_template.php');
require_once ('jumpback.php');
require_once ('login.php');
$databasename = 'image';

if($_FILES && is_uploaded_file($_FILES['upload_image']['tmp_name'])){

  $conn=new mysqli($host,$username,$password,$databasename);
  if($conn->connect_error)die("failed to connect db $databasename");

  // $imagedata = addslashes(file_get_contents($_FILES['upload_image']['tmp_name']));
  $imgData =addslashes (file_get_contents($_FILES['upload_image']['tmp_name']));
  // var_dump($imagedata);
  $imagetype = getimagesize($_FILES['upload_image']['tmp_name']);
  // var_dump($imagetype);
  $imagetype = $imagetype['mime'];
  // $query = "insert into image(imagetype,imagedata) values (?,?)";
  $query = "INSERT INTO image(imagetype ,imageData)
	VALUES('{$imagetype}', '{$imgData}')";
  $stmt=$conn->prepare($query);
  // $stmt->bind_param('sb',$imagetype,$imagedata);
  $stmt->execute();
  if(!$stmt)die('failed to insert image');
  echo "uploading succeed.<br>";
  if(!is_bool($stmt))$stmt->close();
  $conn->close();
  //跳轉至顯示頁面
  header('Location:display.php');
}
echo <<<_HEREDOC
<html !DOCTYPE>
<head><title>upload_image</title></head>
<body>
<form method='post' action='' enctype='multipart/form-data'>
<label>please select your image:</label><br>
<input type='file' name='upload_image'>
<input type="submit" value='upload'>
</form>
</body>
</html>
_HEREDOC




















?>