<?php
/*
echo <<<_END
  <html><head><title>PHP Form Upload</title></head><body>
  <form method='post' action='C:\xampp\htdocs\laravelFolder\resources\views\learning_php\upload.php' enctype='multipart/form-data'>
  Select File:
  <input type='file' name='filename' size='9999999'><br>
  <input type='submit' value='upload'>
  </form>
_END;
if($_FILES){
  print_r($_FILES);
  echo"<br>";
  $name = $_FILES['filename']['name'];
  move_uploaded_file($_FILES['filename']['tmp_name'],$name);
  echo"Uploaded image '$name'<br><img src='$name'>";
}
echo "</body></html>";
*/
?>

<?php // upload.php 
echo <<<_END
<html>
  <head>
    <title>PHP Form Upload</title>
  </head>
  <body> 
    <form method='post' action='upload.php' 
    enctype='multipart/form-data'> 
Select File: <input type='file' name='filename' size='10'><br> 
<input type='submit' value='Upload'> </form>
_END;
if ($_FILES) {
    var_dump($_FILES);
    echo"<br>";
    $file_dir="upload_compress/";
    $name = $file_dir.$_FILES['filename']['name'];
    var_dump($name);
    move_uploaded_file($_FILES['filename']['tmp_name'], $name); 
    echo "Uploaded image '$name'<br><img src='$name'>";
} 
echo "</body></html>"; 
?>