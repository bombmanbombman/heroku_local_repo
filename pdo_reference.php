<?php
//參照https://websitebeaver.com/php-pdo-prepared-statements-to-prevent-sql-injection
// 定義 pdo的各種參數
$dsn = "mysql:host=localhost;dbname=test;charset=utf8mb4";
$username="root";
$password="";
$options = [
  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];
try {
  $pdo = new PDO($dsn, $username, $password, $options);
} catch (Exception $e) {
  error_log($e->getMessage());
  exit('pdo_connect failed.'); //something a user can understand
}

/**準備 sql query  適用於 insert||update||delete
 * 注意!! 這裡的 實際table中的value都使用  ? 作為 placeholder
 * #1 update command example
 * $stmt = $pdo->prepare("UPDATE myTable SET name = ? WHERE id = ?");  
 * $stmt->execute(['$_POST['name'], $_SESSION['id']]);  //這裡的【‘id’】是在$_session中
 * $stmt = null;  //$stmt = null === $stmt->close（）
 * 
 * #2 insert into command example
 * $stmt = $pdo->prepare("INSERT INTO myTable (name, age) VALUES (?, ?)");
 * $stmt->execute([$_POST['name'], $_POST['age']]);
 * $stmt = null;
 * 
 * #3 delete command example 
 * $stmt = $pdo->prepare("DELETE FROM myTable WHERE id = ?");
 * $stmt->execute([$_SESSION['id']]);
 * $stmt = null;
 * 
 * //檢查insert update delete 影響了幾個record 》》》在execute與null直接加入 echo $stmt->rowCount();
 * //return -1 》》》error，
 * //return 0 》》》沒有任何record受影響
 * // return N>0 》》》N個record受影響
 * $stmt = $pdo->prepare("UPDATE myTable SET name = ? WHERE id = ?");
 * $stmt->execute([$_POST['name'], $_SESSION['id']]);
 * if(PDO::MYSQL_ATTR_FOUND_ROWS){echo $stmt->rowCount()."<br>"};
 * $stmt = null;
 * 
 * //檢查更新的值是否違反了 某些需要unique的項目，比如username，email，phone number等
 * //給上面的command 加上 try{}catch(){}
 * try {
 *   $stmt = $pdo->prepare("INSERT INTO myTable (name, age) VALUES (?, ?)");
 *   $stmt->execute([$_POST['name'], 29]);
 *   $stmt = null;
 * } catch(Exception $e) {
 *  if($e->errorInfo[1] === 1062) echo 'Duplicate entry';
 * } 
 */

/**準備 sql query  適用於 select
 * //fetch numeric array 時 
 * PDO::FETCH_NUM
 * eg
 * $stmt = $pdo->prepare("SELECT first_name, squat, bench_press FROM myTable WHERE weight > ?");
 * $stmt->execute([200]);
 * $arr = $stmt->fetchAll(PDO::FETCH_NUM);
 * if(!$arr) exit('No rows');
 * var_export($arr);
 * $stmt = null;
 * 
 * //fetch associative array 時
 * PDO::FETCH_ASSOC  
 * eg1
 * $stmt = $pdo->prepare("SELECT * FROM myTable WHERE id <= ?");
 * $stmt->execute([5]);
 * $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
 * if(!$arr) exit('No rows');
 * var_export($arr);
 * $stmt = null;
 * eg2
 * $arr = [];
 * $stmt = $pdo->prepare("SELECT * FROM myTable WHERE id <= ?");
 * $stmt->execute([5]);
 * while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 *   $arr[] = $row;
 * }
 * if(!$arr) exit('No rows');
 * var_export($arr);
 * $stmt = null;
 * 
 * //fetch 僅僅fetch 一個COLID，或fetch 整個table
 * PDO::FETCH_COLUMN
 * fetch() 或者 fetchALL()
 * eg
 * $stmt = $pdo->prepare("SELECT id, name, age FROM myTable WHERE name = ?");
 * $stmt->execute([$_POST['name']]);
 * $arr = $stmt->fetch();
 * if(!$arr) exit('No rows');
 * var_export($arr);
 * $stmt = null;
 * 
 * //fetch mysql中的 object 對應的一個class
 * PDO::FETCH_CLASS 或者 PDO::FETCH_CLASSTYPE 或者PDO::FETCH_OBJ
 * eg
 * $stmt = $pdo->prepare("SELECT name, age, weight FROM myTable WHERE id > ?");
 * $stmt->execute([12]);
 * $arr = $stmt->fetchAll(PDO::FETCH_CLASS);
 * if(!$arr) exit('No rows');
 * var_export($arr);
 * $stmt = null; 
 */

/**使用transaction 保存臨時記錄點 begin >>> rollback || commit
 * //在pdo中是 beginTransaction();rollback()；commit();
 * try {
 *   $pdo->beginTransaction();
 *   $stmt1 = $pdo->prepare("INSERT INTO myTable (name, state) VALUES (?, ?)");
 *   $stmt2 = $pdo->prepare("UPDATE myTable SET age = ? WHERE id = ?");
 *   if(!$stmt1->execute(['Rick', 'NY'])) throw new Exception('Stmt 1 Failed');
 *   else if(!$stmt2->execute([27, 139])) throw new Exception('Stmt 2 Failed');
 *   $stmt1 = null;
 *   $stmt2 = null;
 *   $pdo->commit();
 * } catch(Exception $e) {
 *   $pdo->rollback();
 *   throw $e;
 * }
 * 
 * 
 */




























































































?>