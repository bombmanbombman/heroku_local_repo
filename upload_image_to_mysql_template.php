<?php  
require_once ('jumpback.php');
require_once ('login.php');
//連接mysqli

/** db.table===image.image   
 * +--------+----------+------+-----+---------+-------+
 *| Field  | Type     | Null | Key | Default | Extra |
 *+--------+----------+------+-----+---------+-------+
 *| images | longblob | NO   |     | NULL    |       |
 *+--------+----------+------+-----+---------+-------+
 */
$databasename='image';
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("can not connect to $databasename");





// 檢驗是否存在 並且display 
if ($_FILES) {
  var_dump($_FILES);
  echo"<br>";
  $file_dir="upload_compress/";
  $name = $file_dir.$_FILES['upload_file']['name'];
  var_dump($name);
  move_uploaded_file($_FILES['upload_file']['tmp_name'], $name); 
  echo "Uploaded image '$name'<br><img src='$name'>";
  
} 
// 插入 table image中 將path中的圖片變為binary『blob』,上傳圖片的名稱進行過濾
if($_FILES && file_exists($name)){
  $image_as_blob=file_get_contents($name);
  var_dump($image_as_blob);
  $images_name = $_FILES['upload_file']['name'];
  var_dump($images_name);
  anti_sql_injection_post($conn,$images_name);
  $stmt="insert into photo values
          (?)";
  $stmt=$conn->prepare($stmt);
  if(!$stmt)echo($conn->error);
  $stmt->bind_param('b',$image_as_blob);
  $result=$stmt->execute();
  if(!$result)die ('insert image query failed');
  if(!is_bool($result))$result->close();
  if(!is_bool($stmt))$stmt->close();
  $conn->close();

  //從mysql從 抽出 圖像 data 並顯示table.image中的所有圖片。


}











// form 部分
echo <<<_END
<html>
  <head>
    <title>Upload image to mysql</title>
  </head>
  <body> 
    <form method='post' action='$_SERVER[PHP_SELF]' 
    enctype='multipart/form-data'> 
Select File:<input type='file' name='upload_file' size='10485760'><br> 
            <input type='submit' class='btn btn-warning' value='Upload'> </form>
_END;

echo "</body></html>"; 
?>