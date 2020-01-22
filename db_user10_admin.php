<?php // db_test_admin.php 
//還沒有包含 insert into 的query
require_once ("jumpback.php");
require_once 'login.php';
$conn = new mysqli($host, 'root', '', 'testdatabase'); 
if ($conn->connect_error) die("Fatal Error");
//運用 user_id 是primary key 來決定是否存在指定record
if (isset($_POST['delete']) && isset($_POST['user_id'])) {
  $user_id = double_check_input($conn, 'user_id'); 
  $query = "DELETE FROM user10 WHERE user_id='$user_id'"; 
  $result = $conn->query($query); 
  if (!$result) echo "DELETE failed<br><br>";
}

if (isset($_POST['username']) && isset($_POST['first_name']) &&
isset($_POST['last_name']) && isset($_POST['gender']) && isset($_POST['password']) && 
isset($_POST['status'])){
  //double_check_input
  $username = double_check_input($conn, 'username'); 
  $first_name = double_check_input($conn, 'first_name');
  $last_name = double_check_input($conn, 'last_name'); 
  $gender = double_check_input($conn, 'gender');
  $password = double_check_input($conn,"password");
  $status = double_check_input($conn,'status');
  $query= "INSERT INTO user10 VALUES" .
  "(null,'$username', '$first_name', '$last_name', '$gender', '$password', '$status')"; 
  $result = $conn->query($query); 
  if (!$result) echo "INSERT failed<br><br>";
}

echo <<<_END
<form action="db_user10_admin.php" method="post">
<pre> 
 Username <input type="text" name="username"> 
Firstname <input type="text" name="first_name"> 
 Lastname <input type="text" name="last_name">
   Gender <input type="text" name="gender"> 
 Password <input type="text" name="password"> 
   status <input type="text" name="status"> 
    <input type="submit" value="ADD RECORD">
</pre>
</form> 
_END;

$query = "SELECT * FROM user10"; 
$result = $conn->query($query);
// var_dump($result);
if (!$result) die ("Database access failed"); 
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j) {
  $row = $result->fetch_array(MYSQLI_BOTH);
  $r0 = htmlspecialchars($row[0]); 
  $r1 = htmlspecialchars($row[1]); 
  $r2 = htmlspecialchars($row[2]); 
  $r3 = htmlspecialchars($row[3]); 
  $r4 = htmlspecialchars($row[4]);
  $r5 = htmlspecialchars($row[5]);
  $r6 = htmlspecialchars($row[6]);
echo <<<_END
  <pre>
   user_id $r0 
  username $r1 
first name $r2 
 last name $r3 
    gender $r4 
  password $r5 
    status $r6 

</pre>
<form action='db_user10_admin.php' method='post'> 
<input type='hidden' name='delete' value='yes'> 
<input type='hidden' name='user_id' value='$r0'> 
<input type='submit' value='DELETE RECORD'></form>
_END; 
//上面的第1，2 input 是給最上方的mvc 決定是否執行delete query 
}
$result->close(); 
$conn->close();
#已經在login.php中declare，所以下面省略。
// function double_check_input($conn, $var) {
//   return $conn->real_escape_string($_POST[$var]);
// }
?>