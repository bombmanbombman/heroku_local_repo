<?php
require_once "2019pdoconnect.php";
/*c8 */
#1 ; is to end a statement
#2 show databases; show tables;
#3 grant user username password ps
#4 desc tablename
#5 for quickened searching
#6 for quickened searching
#7 \c
#8 select distinct >>> not show duplicate result
# group by COLID show the most result descend order
#9 select * from tablename
#    where author like '%Langhorne%';
#10 select COLID11,COLID21 from table1 inner join table2
#     on table1.COLID11 = table2.COLID21;
#11 alter +change||modify||add||drop||rename||
/*
alter table tablename COLID newCOLID datatype(length) NOT null attribute;
alter table tablename modify COLID datatype(length) NOT NULL attribute;
alter table tablename1 rename tablename2
alter table tablename drop COLID
alter table tablename add COLID datatype(length)NOTNULL default() attribute


*/
#12
/*
mysqldump -u root -p --all-databases>xxxx.sql
mysql -u root -p<xxxx.sql
*/
#13
/*
create database databasename
create table tablename (
  COLID1 datatype(length) default() attribute,
  COLID2 datatype(length) default() attribute,

)ENGINE InnoDB;

* */
#14
/**
 * use databasename
 * desc tablename
 * show databases
 * show tables
 */
#15
/**
 * drop databasename
 * drop tablename
 */
# 16
/**
 *insert into tablename (COLID1,COLID2,...,COLIDN)values
 * (value11,value12,...valueN)
 * ()
 */
# 17 
/**
 * update tablename 
 *   set COLID1 = value1 COLID2 = value2
 *   where condition1 and||or condition2
 */
#18
/**
 * truncate table tablename
 */
#19
/**
 * repair
 */

//c7
#1
/**
 * printf('xxx%nx%sxx',arg2,arg3):int||string;
 */
printf("today is %s,it's october %d",'thursday',21);
echo '<br>';
#2
printf("%+'*7.5s",'Happy Birthday');
echo "<br>";
#3 sprintf
#4 
print($var1=mktime(13,15,0,11,21,2019));
echo "<br>";
print(date(DATE_COOKIE,$var1));
echo "<br>";
#5
$target=fopen('test.txt','w+');
fwrite($target,'big daikon');
$content = file_get_contents('test.txt');
echo $content."<br>";
echo fclose($target)."<br>";
#6
unlink('test.txt');
#7
do{
  if(!$_FILES){
    break;
  };
  var_dump($_FILES);
  // define('current_location',dirname(__FILE__));
  // $image=current_location."/upload//";
  $image = $_FILES['filename']['tmp_name'];
  // move_uploaded_file($_FILES['filename']['tmp_name'],$image);
  echo "your uploaded this image:$image<br>";
  echo '<img alt="sth error" src = "$image">';
}while(0);

echo <<<_heredoc
<html>
  <title>20191121</title>
  <body>
    <form method="post" action="20191121.php" enctype="multipart/form-data">
      <input type="file" name="filename" size="10"><br>
      <input type="submit" value="clickme"><br>
    </form>
  </body>
</html>
_heredoc;
















?>
