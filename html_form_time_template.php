<?php  
// mvc 部分  測試 insert query
/** db:table>>> project1.test_datetime
 * +-------+----------+------+-----+---------+-------+
 * | Field | Type     | Null | Key | Default | Extra |
 * +-------+----------+------+-----+---------+-------+
 * | time  | datetime | YES  |     | NULL    |       |
 * +-------+----------+------+-----+---------+-------+
 */
if(count($_POST)===6){
  require_once ('login.php');
  $databasename='project1';
  $conn= new mysqli($host,$username,$password,$databasename);
  $query='insert into test_datetime
            set time = ?';
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  double_check_input($conn,$_POST['year']);
  double_check_input($conn,$_POST['month']);
  double_check_input($conn,$_POST['day']);
  double_check_input($conn,$_POST['hour']);
  double_check_input($conn,$_POST['minute']);
  double_check_input($conn,$_POST['second']);
  $query_time=$_POST['year']."-".$_POST['month']."-".$_POST['day']." ".$_POST['hour'].":".$_POST['minute'].":".$_POST['second'];
  var_dump($query_time);
  echo "<br>";
  $stmt->bind_param('s',$query_time);
  $stmt->execute();
  if(!$stmt->execute())die('insert query failed');
  $prequire = 'true';
}



require_once("jumpback.php");
//改變時區  設定為上海時區。
date_default_timezone_set('Asia/Shanghai');
echo $current_time=date('Y_m_d_H_i_s');
$now=explode('_',$current_time);
var_dump($now);
echo <<<_HEREDOC
<html !DOCTYPE>
<head><title>inserting time</title></head>
<body>
<pre>
<form method="post" action="">
<input type="text" value='$now[0]' name='year'><label>年（只能輸入4位數字）</label>
<input type="text" value='$now[1]' name='month'><label>月（必須輸入2位數字01~12）</label>
<input type="text" value='$now[2]' name='day'><label>日(必須輸入2位數字01～31)</label>
<input type="text" value='$now[3]' name='hour'><label>時（必須輸入2位數字00～23）</label>
<input type="text" value='$now[4]' name='minute'><label>分（必須輸入2位數字00～59）</label>
<input type="text" value='$now[5]' name='second'><label>秒（必須輸入2位數字00～59）</label>
<input type="submit" value='insert into test_datetime'>
</form>
</pre>
</body>
</html>
_HEREDOC;

//測試 select query
if(isset($prequire)){
  $query='select * from test_datetime';
  $stmt=$conn->prepare($query);
  if(!$stmt)echo($conn->error);
  $stmt->execute();
  if(!$stmt->execute())die('select query failed');
  $result_stmt=$stmt->get_result();
  while($row=$result_stmt->fetch_assoc()){
    $date_purchase=$row['time'];
    echo "買入的時間是 $date_purchase.<br>";
  }
}

















?>