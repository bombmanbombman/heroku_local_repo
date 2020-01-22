<?php // db_test_admin.php 
//還沒有包含 insert into 的query
require_once ("jumpback.php");
require_once 'login.php';
$conn = new mysqli($host, $username, $password, $databasename); 
if ($conn->connect_error) die("Fatal Error");
//運用 isbn 是primary key 來決定是否存在指定record
if (isset($_POST['delete']) && isset($_POST['isbn'])) {
  $isbn = get_post($conn, 'isbn'); 
  $query = "DELETE FROM classic WHERE isbn='$isbn'"; 
  $result = $conn->query($query); 
  if (!$result) echo "DELETE failed<br><br>";
}

if (isset($_POST['author']) && isset($_POST['title']) &&
isset($_POST['category']) && isset($_POST['year']) && 
isset($_POST['isbn'])){
  //get_post
  $author = get_post($conn, 'author'); 
  $title = get_post($conn, 'title');
  $category = get_post($conn, 'category'); 
  $year = get_post($conn, 'year');
  $isbn = get_post($conn, 'isbn');
  $query= "INSERT INTO classic VALUES" .
  "('$author', '$title', '$category', '$year', '$isbn')"; 
  $result = $conn->query($query); 
  if (!$result) echo "INSERT failed<br><br>";
}

echo <<<_END
<form action="db_test_admin.php" method="post">
<pre> 
  Author <input type="text" name="author">
   Title <input type="text" name="title"> 
Category <input type="text" name="category">
    Year <input type="text" name="year"> 
    ISBN <input type="text" name="isbn"> 
    <input type="submit" value="ADD RECORD">
</pre>
</form> 
_END;

$query = "SELECT * FROM classic"; 
$result = $conn->query($query);
if (!$result) die ("Database access failed"); 
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j) {
  $row = $result->fetch_array(MYSQLI_BOTH);
  $r0 = htmlspecialchars($row[0]); 
  $r1 = htmlspecialchars($row[1]); 
  $r2 = htmlspecialchars($row[2]); 
  $r3 = htmlspecialchars($row[3]); 
  $r4 = htmlspecialchars($row[4]);
echo <<<_END
  <pre>
  Author $r0 
   Title $r1 
Category $r2 
    Year $r3 
    ISBN $r4
</pre>
<form action='db_test_admin.php' method='post'> 
<input type='hidden' name='delete' value='yes'> 
<input type='hidden' name='isbn' value='$r4'> 
<input type='submit' value='DELETE RECORD'></form>
_END; 
//上面的第1，2 input 是給最上方的mvc 決定是否執行delete query 
}
$result->close(); 
$conn->close();
function get_post($conn, $var) {
  return $conn->real_escape_string($_POST[$var]);
}
?>