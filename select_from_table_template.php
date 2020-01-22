<?php
require_once ('jumpback.php');
require_once ('login.php');
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("unable to access $databasename");
$query = "select * from cats";
$result =$conn->query($query);
if(!$result)die ('select query failed');
$total_record = $result->num_rows;


echo "<table><tr><th>id</th><th>family</th><th>name</th><th>age</th></tr>";
for ($i=0;$i<$total_record;$i++){
  echo "<tr>";
  $row = $result->fetch_array(MYSQLI_BOTH);
  for($j=0;$j<4;$j++){
    echo "<td>".htmlspecialchars($row[$j])."</td>";
  }
  echo "</tr>";
}
echo "</table>";

if(!is_bool($result)) $result->close();
$conn->close();





























?>