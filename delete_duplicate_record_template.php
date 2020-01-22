<?php
require_once ('jumpback.php');
require_once ('login.php');
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("failed to connect db $databasename");
//尋找重複的record的個數與對應column中的value。
$query = "SELECT family,name,age,count(*) FROM cats
            GROUP BY family,name,age
            HAVING count(*)>1";
$result=$conn->query($query);
if(!$result)die('failed to find duplicated record');
var_dump($result);
$total_record=$result->num_rows;
echo "<table><tr><th>family</th><th>name</th><th>age</th><th>count(*)</th></tr>";
for($i=0;$i<$total_record;$i++){
  $row=$result->fetch_array(MYSQLI_BOTH);
  echo "<tr>";
  for($j=0;$j<4;$j++){
    echo "<td>".htmlspecialchars($row[$j])."</td>";
  }
  echo "</tr>";
}
echo"</table>";
//使用 delete alias1 from tablename alias1 inner join tablename alias2 
//where alias1.id > alias2.id and alias1.COLID = alias2.COLID and... 刪除重複項
$query = "DELETE a1 FROM cats a1 
            INNER JOIN cats a2
            WHERE a1.id > a2.id 
              AND a1.family = a2.family
              AND a1.name = a2.name
              AND a1.age = a2.age";
$result=$conn->query($query);
if(!$result)die("failed to delete duplicated record.");
echo "succeed in deleting.";
if(!is_bool($result))$result->close();
$conn->close();






























?>