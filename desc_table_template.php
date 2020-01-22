<?php
require_once ('jumpback.php');
require_once ('login.php');
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)echo"fail to connecting to $databasename <br>";
$query = 'describe cats';
$result = $conn->query($query);
if(!$result)die('describe table failed.');
// var_dump ($result);
//檢查有幾個record
$total_record = $result->num_rows;
var_dump($total_record);
//注意!! <tr></tr>表示record  <th></th> 表示COLID <td></td>表示column
echo "<table><tr><th>Field</th><th>Type</th><th>Null</th><th>key</th><th>Default</th><th>Extra</th></tr>";
for(
  $j=0; $j<$total_record;++$j) {
  $row=$result->fetch_array(MYSQLI_NUM);
  echo "<tr>";
  for($k=0;$k<6;++$k){
    echo"<td>".htmlspecialchars($row[$k])."</td>";
  }
  echo "</tr>";
}
echo "</table>";

if(!is_bool($result))$result->close();
$conn->close();































?>