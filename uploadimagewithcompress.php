
<?php
require_once('2019pdoconnect.php');
session_start();
$submit='';
$upload_dir="upload_compress/";
//check uploaded file is exist or not,and whether it is an image or not
do{
  if(!isset($_POST['submit'])){
    echo "アップロードしたい画像を選択してください<br>";
    break;
  }
  $target_file = $upload_dir . basename($_FILES['uploaded_file']['name']);
  $imageFiletype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  var_dump($_FILES);
  $check = getimagesize($_FILES['uploaded_file']['tmp_name']);
  if($check === false){
    echo "これは画像ファイルではないようです。<br>";
    break;
  }
  echo $check['mime']."の形式のファイルですが<br>";
  if(file_exists($target_file)){
    echo "すでにあったファイルのようです。<br>";
    var_dump($target_file);
    echo
    <<<_HEREDOC3
    <img src="$target_file">
_HEREDOC3;
    break;
  };
  if($_FILES['uploaded_file']['size']>10485760){
    echo "10メガバイト以上のファイルは受け付けません。<br>";
    break;
  };
  if($imageFiletype !='jpg' && $imageFiletype !='png' && $imageFiletype !='jpeg' && 
  $imageFiletype !='gif'){
    echo "jpg,jpeg,png,gif以外のファイルは受け付けません。<br>";
    break;
  }
  if(!move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$target_file)){
    echo"何のエラーが発生したため、保存できませんでした。<br>";
    break;
  }
  echo basename($_FILES["uploaded_file"]["name"])."アップロード成功しました。<br>";
  echo 
<<<_HEREDOC1
<img alt="error happended" src="$target_file">
_HEREDOC1;
$_POST['submit']=$submit;
session_abort();
}while(0);

echo <<<_HEREDOC2
<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <title>PHP Form Upload</title>
  </head>
  <body> 
    <form method="post" action='$_SERVER[PHP_SELF]' 
    enctype='multipart/form-data'> 
    アップロード画像ボタン: <input type='file' name='uploaded_file' size='999999' id='upload'><br> 
    <input type='submit' name='submit' value='OK'> 
    </form>
  </body>
</html>
_HEREDOC2;
?>