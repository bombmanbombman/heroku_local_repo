<?php
// c10
#1
require_once ('jumpback.php');
require_once ('login.php');
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error) die("connect failed");
$query = "select * from cats";
$result = $conn->query($query);
if(!$result)die("select query failed");
$total_record=$result->num_rows;
var_dump($total_record);
echo "<table><tr><th>id</th><th>family</th><th>name</th><th>age</th></tr>";
for($i=0;$i<$total_record;$i++){
  $row = $result->fetch_array(MYSQLI_BOTH);
  echo "<tr>";
  for($j=0;$j<4;$j++){
    echo "<th>".htmlspecialchars($row[$j])."</th>";
  }
  echo "</tr>";
}
echo "</table>";
$total_record=$result->num_rows;
for($i=0;$i<$total_record;$i++){
  $index=$i+1;
  echo "this is $index th record<br>";
  $result ->data_seek($i);
  echo "id will be :".htmlspecialchars($result->fetch_assoc()['id']),"<br>";
  $result ->data_seek($i);
  echo "family will be :".htmlspecialchars($result->fetch_assoc()['family']),"<br>";
  $result ->data_seek($i);
  echo "name will be :".htmlspecialchars($result->fetch_assoc()['name']),"<br>";
  $result ->data_seek($i);
  echo "age will be :".htmlspecialchars($result->fetch_assoc()['age']),"<br>";
}

$query = "insert into cats values
            (null,'puma','gribble','6')";
$result = $conn->query($query);
if(!$result)die("insert query failed");

$query = "update cats
            set family = 'serval cat',name = 'serval chan'
            where family='puma' ";
$result = $conn->query($query);
if(!$result)die('update query failed');

$stmt = "insert into cats values(?,?,?,?)";
$stmt=$conn->prepare($stmt);
if(!$stmt)echo($conn->error);
$stmt->bind_param('issi',$id,$family,$name,$age);
$id=0;$family= 'bob cat';$name='bombobee';$age=6;
$result=$stmt->execute();
if(!$result)die("place holder failed ");
echo ($stmt->affected_rows). ' record has been inserted.<br>';

$query = "select family,name,age,count(*) from cats
            group by family,name,age
            having count(*)>1";
$result = $conn->query($query);
if(!$result)die("select query failed at count");
$total_record3=$result->num_rows;
// var_dump($total_record3);

echo '<table><tr><th>family</th><th>name</th><th>age</th><th>count(*)</th></tr>';
for($i=0;$i<$total_record3;$i++){
  echo '<tr>';
  $rows = $result->fetch_array(MYSQLI_BOTH);
  for($j=0;$j<4;$j++){
    echo "<th>".htmlspecialchars($rows[$j])."</th>";
  }
  echo "</tr>";
}
echo "</table>";

$query = " delete a1 from cats a1 
            inner join cats a2
            where a1.id>a2.id and
            a1.family=a2.family and
            a1.name=a2.name and
            a1.age=a2.age";
$result=$conn->query($query);
if(!$result)die ('delete duplicate query failed');








$query = "select * from cats";
$result = $conn->query($query);
if(!$result)die("select query failed");
$total_record2= $result->num_rows;
// var_dump($total_record2);
echo "<table><tr><th>id</th><th>family</th><th>name</th><th>age</th></tr>";
for($i=0;$i<$total_record2;$i++){
  echo "<tr>";
  $row=$result->fetch_array(MYSQLI_BOTH);
  // var_dump($row);
  for($j=0;$j<4;$j++){
    echo "<th>".htmlspecialchars($row[$j])."</th>";
  }
  echo "</tr>";
}
echo "</table>";

if(!is_bool($stmt))$stmt->close();
if(!is_bool($result))$result->close();
$conn->close();



?>