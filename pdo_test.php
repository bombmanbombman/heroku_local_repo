<?php
$user ="root";
$password ="";
$databasename="test";
try{
  $pdo=new PDO("mysql:host=localhost;port=3306;$databasename",$user,$password);
}catch(PDOException $e){
  echo 'failed to connect pdo:'.$e->getMessage();
}
;
if($pdo=new PDO("mysql:host=localhost;port=3306;$databasename",$user,$password)){
$pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
echo "succeed connecting to database test<br>";
};
?>