<?php
require_once("login.php");
$conn=new mysqli($host,$username,$password,$databasename);
if($conn->connect_error){
  echo "無法連接數據庫，$databasename ， 回到註冊頁面","<br>";
  require_once ('test_header.php');
  exit();
}
$query="insert into tester values(?,?)";
$null=null;
$stmt=$conn->prepare($query);
if(!$stmt)echo($conn->error);
$stmt->bind_param('ib',$null,$null);
if(isset($_FILES['test_icon'])){
  $test_icon=file_get_contents($_FILES['test_icon']['tmp_name']);
  $stmt->send_long_data(1, $test_icon);
}
if(!$stmt->execute()){
  echo <<<_HEREDOC
<form action ='$_SERVER[PHP_SELF]' method='post' enctype='multipart/form-data'>

<input type='file' name='test_icon'>
<input type='submit'>
</form>
_HEREDOC;
}else{
  $query = "select test_icon from tester where test_id = 1";
  $stmt=$conn->query($query);
  $row = $stmt->fetch_assoc();
  // echo '<img src="data:image/jpeg;base64,'.base64_encode($row['test_icon']).'"/><br>';
}







?>