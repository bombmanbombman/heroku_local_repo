<?php
require_once ("jumpback.php");
require_once ("login.php");
$conn = new mysqli($host,$username,$password,$databasename);
if($conn->connect_error)die ("failed to connect db $databasename");
$query = "select * from cats";
if(get_magic_quotes_gpc())$query=stripcslashes($query);
$query=$conn->real_escape_string($query);
$result = $conn->query($query);
if(!$result)die("select query failed.");
$total_record = $result->num_rows;
// var_dump($total_record);
echo "<table><tr><th>id</th><th>family</th><th>name</th><th>age</th></tr>";
for($i=0;$i<$total_record;$i++){
  echo "<tr>";
  $row=$result->fetch_array(MYSQLI_BOTH);
  for($j=0;$j<4;$j++){
    echo "<th>".htmlspecialchars($row[$j])."</th>";
  }
  echo "</tr>";
}
echo "</table>";
for($k=0;$k<$total_record;$k++){
  $index=$k+1;
  $result->data_seek($k);
  echo "this is $index th record.<br>";
  echo "the id is ".$result->fetch_assoc()['id']."<br>";
  $result->data_seek($k);
  echo "the family is ".$result->fetch_assoc()['family']."<br>";
  $result->data_seek($k);
  echo "the name is ".$result->fetch_assoc()['name']."<br>";
  $result->data_seek($k);
  echo "the age is ".$result->fetch_assoc()['age']."<br><br>";
}
$result->data_seek(3);
echo "my cat named ".$result->fetch_assoc()['name']."<br>";

$query="insert into cats values
          (null,'cougar','jaguar',12)";
// if(get_magic_quotes_gpc())$query=stripcslashes($query);
// $query=$conn->real_escape_string($query);
$result=$conn->query($query);
if(!$result)die('insert query failed');

$query="update cats set name='jougar'
          where family = 'cougar'";
$result= $conn->query($query);
if(!$result)die('update query failed');

$query = "delete from cats
            where id = 25";
$result=$conn->query($query);
if(!$result)die('delete query failed');


$query = "select family,name,age,count(*) from cats
            group by family,name,age
            having count(*)>1";
$result = $conn->query($query);
if(!$result)die("select duplicated query failed.");
$total_record = $result->num_rows;
// var_dump($total_record);
echo "<table><tr><th>family</th><th>name</th><th>age</th><th>count(*)</th></tr>";
for($i=0;$i<$total_record;$i++){
  echo "<tr>";
  $row=$result->fetch_array(MYSQLI_BOTH);
  for($j=0;$j<4;$j++){
    echo "<th>".htmlspecialchars($row[$j])."</th>";
  }
  echo "</tr>";
}
echo "</table>";

$query = "delete a1 from cats a1
            inner join cats a2
            where a1.id>a2.id AND
              a1.family=a2.family AND
              a1.name=a2.name AND
              a1.age=a2.age";
$result = $conn->query($query);
if(!$result)die("delete duplicated query failed");

$query = "select * from cats";
$result = $conn->query($query);
if(!$result)die("select query failed.");
$total_record = $result->num_rows;
// var_dump($total_record);
echo "<table><tr><th>id</th><th>family</th><th>name</th><th>age</th></tr>";
for($i=0;$i<$total_record;$i++){
  echo "<tr>";
  $row=$result->fetch_array(MYSQLI_BOTH);
  for($j=0;$j<4;$j++){
    echo "<th>".htmlspecialchars($row[$j])."</th>";
  }
  echo "</tr>";
}
echo "</table>";

if(!is_bool($result))$result->close();
$conn->close();

//c4
/**#1
 * 0 null ‘’ array() empty object
 * literal variable
 *  $var++   $var1+$var2  $var?statement1:statement2;
 * #4 ()
 * #5 none left right
 * #6 bypass datatype convert
 * #7 if(){} for(){} ternary ? : while(){} do{}while() switch $var
 * #8 continue
 * #9 for(initial;condition;change){}
 * #10 變為 boolean
 * #11 TRUE FALSE可以被用於 constantname
 * #12 ! /*% +- >=<=<>  && || ?:  .= += and xor or 
 * #13 ++ -- ! /*% +- <=> === == && || ?: .= and xor or
 * #14 none === == >= <=
 *     right ! ++ -- (datatype)() +=
 *     left +- .= ?:
 * #15  $var?ture:false;
 *  
 * 
 * 
 */
//c7
/**
 * #1 print
 */
printf('i see sb bring %s',"umberallar");
echo '<br>';
#2
printf("%'*7.5s",'Happy Birthday');
echo '<br>';
#3 sprintf
#4
$timestamp=mktime(7,11,0,5,2,2016);
echo date(DATE_COOKIE,$timestamp),"<br>";
// #5 fopen($path,'w+'):resource;
#6 unlink($path);
#7 file_get_contents($path||url)
#8 $_FILES
echo <<<_HEREDOC
<html>
<head><title>20191125</title></head>
<body>
<form method='post' action="" enctype=multipart/form-data>
<input type='text' name='text_test'>
<input type='submit' value='exe query'>
</form>
</body>
</html>
_HEREDOC;
$resource=fopen('test3.txt','w+');
fwrite($resource,'please free hk');
$read=file_get_contents('test3.txt');
echo $read,"<br>";
fclose($resource);

?>