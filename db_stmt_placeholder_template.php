<?php
require_once ('jumpback.php');
require_once ('login.php');

$databasename='image';
$conn=new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("failed to connect $databasename");
//使用$row ->$result->fetch_assoc  已知COLID名稱
$query = "SELECT imageid FROM image;";
$result=$conn->query($query);
if(!$result)die('select id query failed');
$total_record=$result->num_rows;
$total_column=$result->field_count;
while($row=$result->fetch_assoc()){
  $imageid=$row['imageid'];
  $imageid=(int)($imageid);
  var_dump($imageid);  
  echo " is imgid<br>";
  $query = "SELECT imagedata,imagetype FROM image WHERE imageid = ?";
  $stmt=$conn->prepare($query);
  var_dump($stmt);
  if(!$stmt)echo($conn->error);
  echo " is stmt prepare<br>";
  $stmt->bind_param('i',$imageid);
  var_dump($stmt->bind_param('i',$imageid));
  echo " is bind_param<br>";
  $stmt->execute();
  $result_stmt=$stmt->get_result();
  var_dump($result_stmt);
  echo " !!is get_result<br>";
  while($row=$result_stmt->fetch_assoc()){
    echo $row['imagetype'],"<br>";
    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imagedata']).'"/><br>';
  }
}

// 使用$row=$result->fetch_array(MYSQLI_BOTH)  未知COLID名稱
echo "<br><br>second way";
$query = "SELECT imageid FROM image;";
$result=$conn->query($query);
if(!$result)die('select id query failed');
$total_record=$result->num_rows;
$total_column=$result->field_count;
while($row=$result->fetch_assoc()){
  $imageid=$row['imageid'];
  $imageid=(int)($imageid);
  var_dump($imageid);  
  echo " is imgid<br>";
  $query = "SELECT imagedata,imagetype FROM image WHERE imageid = ?";
  $stmt=$conn->prepare($query);
  var_dump($stmt);
  echo " is stmt prepare<br>";
  $stmt->bind_param('i',$imageid);
  var_dump($stmt->bind_param('i',$imageid));
  echo " is bind_param<br>";
  $stmt->execute();
  $result_stmt=$stmt->get_result();
  var_dump($result_stmt);
  echo " !!is get_result<br>";
  $total_record2=$result_stmt->num_rows;
  for($i=0;$i<$total_record2;$i++){
    $row=$result_stmt->fetch_array(MYSQLI_BOTH);
    $col=$result_stmt->field_count;
    for($j=0;$j<$col;$j++){
      if (is_base64($row[$j])){
        echo $row[$j],"<br>";
      } else {
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row[$j]).'"/><br>';
      }
    }
  }
}

//third way 用$stmt->store_result->bind_result($COLID1,$COLID2..)->fetch()
echo "<br><br>the third way begin ";
$query = "SELECT imageid FROM image;";
$result=$conn->query($query);
if(!$result)die('select id query failed');
$total_record=$result->num_rows;
$total_column=$result->field_count;
while($row=$result->fetch_assoc()){
  $imageid=$row['imageid'];
  $imageid=(int)($imageid);
  var_dump($imageid);  
  echo " is imgid<br>";
  $query = "SELECT imagedata,imagetype FROM image WHERE imageid = ?";
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  var_dump($stmt);
  echo " is stmt prepare<br>";
  $stmt->bind_param('i',$imageid);
  var_dump($stmt->bind_param('i',$imageid));
  echo " is bind_param<br>";
  $stmt->execute();
  $stmt->store_result();
  var_dump($stmt->store_result());
  echo " is store_result<br>";
  if(!$result_stmt)die('select imagedata,imagetype failed');
  $stmt->bind_result($imagedata,$imagetype);
  var_dump($stmt->bind_result($imagedata,$imagetype));
  echo " is bind_result<br>";
  while($stmt->fetch()){#當bind_result有2個以上的arg時，要用while。
  var_dump($stmt->fetch());  
  echo " is fetch <br>";
  
    header("Content-type:".$imagetype);
    echo $imagetype,"<br>";
    // echo $imagedata,"<br>";
    echo '<br><img src="data:image/jpeg;base64,'.base64_encode( $imagedata ).'"/><br>';
  }
}
// $query = "SELECT imageid FROM image;";
// $result=$conn->query($query);
// if(!$result)die('select id query failed');
// var_dump($result); 
// echo " is result1<br>";
// $total_record=$result->num_rows;
// $total_column=$result->field_count;
// for($i=0;$i<$total_record;$i++){
  // $what=$result->data_seek($i);
  // var_dump($what);
  // echo " is data_seek<br>";
  // $imageid=$result->fetch_assoc()['imageid'];
  // $imageid=(int)($imageid);
  // var_dump($imageid);  
  // echo " is imgid<br>";
  // $query = "SELECT imagedata,imagetype FROM image WHERE imageid = ?";
  // $stmt=$conn->prepare($query);
  // if(!$stmt)echo($conn->error);
  // var_dump($stmt);
  // echo " is stmt prepare<br>";
  // $stmt->bind_param('i',$imageid);
  // var_dump($stmt->bind_param('i',$imageid));
  // echo " is bind_param<br>";
  // $stmt->execute();
  // $result_stmt=$stmt->get_result();
  // var_dump($result_stmt);
  // echo " !!is get_result<br>";
  // while($row=$result_stmt->fetch_assoc()){
    // echo $row['imagetype'],"<br>";
    // echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imagedata']).'"/><br>';
  // }
  // $stmt->store_result();
  // var_dump($stmt->store_result());
  // echo " is store_result<br>";
  // if(!$result_stmt)die('select imagedata,imagetype failed');
  // $stmt->bind_result($imagedata,$imagetype);
  // var_dump($stmt->bind_result($imagedata,$imagetype));
  // echo " is bind_result<br>";
  // while($stmt->fetch()){#當bind_result有2個以上的arg時，要用while。
  // var_dump($stmt->fetch());  
  // echo " is fetch <br>";
  // 
    // header("Content-type:".$imagetype);
    // echo $imagetype,"<br>";
    // echo $imagedata,"<br>";
    // echo '<br><img src="data:image/jpeg;base64,'.base64_encode( $imagedata ).'"/><br>';
  // }
// }








?>