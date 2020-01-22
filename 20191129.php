<?php
require_once("html_navibar_template.php");

/**c9
 * 1 table 1 table 2 的data 有關聯
 * 2 normalization
 * 3 form1 去除 COLID中 有重複column那個 COLID 獨立出去
 * 一個column 不能包含 超過一種以上的datatype，如果有應該分裂成多個COLID 並且獨立出去
 * 每個table都必須有primary key
 * 4 form2  找出 多個 COLID 的 column中有 複數個 row 組成的重複的data 將這些COLID獨立出去
 * 5 必須使 tableone 的 primary key 在 tablemany中成為 foreign key
 * 6 必須有tablebridge 中間包含了 各個 tablemany的primary COLID，但是都作為獨立的foreign key
 * 不能包含其他任何COLID
 * 7 begin >>>> commit  取消時 rollback;
 * 8 explain 
 * 9 mysqldump -u root --all-databases>pathlocation.sql
 *   mysql -u root <pathlocation.sql
 */

/**c1
 * 1 php nodejs mysql javascript apache
 * 2hyper text markup language
 * 3 structure query language
 * 4 
 * 5cascade style sheet
 * video canvas audio header
 * 7 community
 * 8 not any more
 */

require_once("login.php");
$conn= new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die("failed at connect db $databasename");
$query = "select * from user";
$stmt = $conn->prepare($query);
if(!$stmt->execute())echo($conn->error);
$result_stmt=$stmt->get_result();
$rows=$result_stmt->num_rows;
$cols=$result_stmt->field_count;
echo <<<_HEREDOC
<br><br><br>
<table><tr><th>user_id</th><th>user_name</th><th>email</th></tr>
_HEREDOC;
for($i=0;$i<$rows;$i++){
  $row=$result_stmt->fetch_array(MYSQLI_BOTH);
  echo "<tr>";
  for($j=0;$j<3;$j++){
    echo "<th>$row[$j]</th>";
  }
  echo "</tr>";
}
echo "</table>";

$query = "select * from user";
$stmt = $conn->prepare($query);
if(!$stmt->execute())echo($conn->error);
$result_stmt=$stmt->get_result();
// var_dump($result_stmt);
for($i=0;$i<$rows;$i++){
  $row=$result_stmt->fetch_assoc();
  echo $row['email'],"<br>";
}
var_dump($row);












?>