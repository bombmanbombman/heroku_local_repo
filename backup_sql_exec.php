<?php
$URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
if(strpos($URL,'herokuapp.com')){
  echo "<div>$URL</div>";
}else{
  echo "<div>$URL</div>";
}
require_once("html_navibar_template.php");
require_once("html_dropup_button_template.php");
require_once("jumpback.php");
//改變開始的directory的位置
chdir("c:/xampp/mysql");
//測試
// $cmd = "dir"; // Windows // $cmd = "ls"; // Linux, Unix & Mac
// $result=shell_exec(escapeshellcmd($cmd), $output, $status);
// if ($status) echo "Exec command failed"; 
// else {
// echo "<pre>";
// foreach($output as $line) echo htmlspecialchars("$line\n"); 
// echo "</pre>";
// }

$backup_file_name="project1".date('Y-m-d-H-i-s').".sql";
$cmd='mysqldump -f -u root project1 > c:/xampp/htdocs/laravelFolder/resources/views/learning_php/mysql_back/'.$backup_file_name;
// $result = exec(escapeshellcmd($cmd),$output,$status);
$result = exec($cmd,$output,$status);

if ($status) {
  echo "Exec command failed";
} 
else {
echo "<pre>";
foreach($output as $line) echo htmlspecialchars("$line\n"); 
echo '<br>backdump has been created';
echo "</pre>";
}
























?>