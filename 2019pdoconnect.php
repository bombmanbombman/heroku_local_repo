<?php
$dbservername="localhost";  #xampp默認的servername
$dbusername="root";  #xampp 默認的username
$dbpassword="";#xampp root對應的 password
$databasename="testdatabase";#要輸入對應的database 名。
#mysqli_connect() function用於連接mysql server
/*  
$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$databasename);
if (mysqli_connect_errno()){
    echo "failed to connect mysql server.here is the reason :".mysqli_connect_error();
}else{
    echo "CONNECTED to database=$databasename,GOOD　JOB!!<br>";
};
*/
#使用PDO class 連接到mysql server上。
//mysql 中使用的 sql syntax 語言 ,double quotation中是 sql syntax語言
/*
$tablemaker="CREATE TABLE IF NOT EXISTS userlogin(
    user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_first varchar(256) not null,
    user_last varchar(256) not null,
    user_email varchar(256) not null UNIQUE,
    user_uid varchar(256) not null,
    user_pwd varchar(256) not null,
);";
#用於向mysql server 發出 query 命令 也可以用builtin mysqli class

$stmt=$conn->prepare($tablemaker);
$stmt->execute();*/
//or die("fail to send query to db=$databasename,query= \$tablemaker ");<?php
/*$change_table_name="RENAME TABLE user_details TO user100;";*/#已經執行 fuji902
/*$change_table_name="RENAME TABLE user_details TO user10;";*/#已經執行 fuji902
//$stmt=$conn->prepare($change_table_name);
//$stmt->execute();
//die("fail to send query to db=$databasename,query: \$change_talbe_name='${change_table_name}' ");
/*INSERT INTO userlogin(user_first,user_last,user_email,user_uid,user_pwd)
    VALUES('bomb','man','bombmanbombman@gmail.com','Admin','63079861');
*/
class _PDO extends PDO{ 
    var $databaseservername="localhost";
    var $databaseusername="root";
    var $databasepassword=""; 
    var $databasename="testdatabase";
    public function __construct($databasename="testdatabase",$dbservername="localhost",$dbusername="root",$dbpassword=""){
        $this->databaseservername = $dbservername;
        $this->databaseusername = $dbusername ;
        $this->databasepassword = $dbpassword;
        $this->databasename = $databasename;
        try {
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            // echo "CONNECTED to database=$databasename,the object name is \$conn & _PDO
            // GOOD　JOB!!<br>"; 
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
        $conn=null;
    }
    static function _create_table_if_not_exists(
        $tablename,
        $col1='user_id int(11) AUTO_INCREMENT PRIMARY KEY not null',
        $col2='name varchar(256) not null',
        $col3='type varchar(256) not null',
        $col4='tmp_name varchar(256) not null ',
        $col5='location varchar(256) not null',
        $col6='size int(50) not null'
    ){
        //global $col1,$col2,$col3,$col4,$col5,$col6;
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        $tablemaker="CREATE TABLE IF NOT EXISTS userlogin(
            user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
            user_first varchar(256) not null,
            user_last varchar(256) not null,
            user_email varchar(256) not null UNIQUE,
            user_uid varchar(256) not null,
            user_pwd varchar(256) not null,
        );";
        $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
        try {
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            do{
                try{ $result = $conn->query("SELECT 1 FROM $tablename LIMIT 1");
                    if($result){
                        echo "<h1><font color=green >talbename = $tablename already exist</font></h1>";
                        return;
                    }
                } catch (Exception $e) {echo $result . "<br>" . $e->getMessage();
                }
            }while(0);
            $sql = "CREATE TABLE IF NOT EXISTS $tablename(
                $col1,
                $col2,
                $col3,
                $col4,
                $col5,
                $col6
            );";
            // use exec() because no results are returned
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            // $conn->prepare($sql);
            // $conn->exec($sql);
            echo "<h1><font color=BLUE >NEW talbename = $tablename has been CREATED</font></h1>";
        }catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
        $conn=null;
    }

    static function _drop_table($tablename){
        //global $col1,$col2,$col3,$col4,$col5,$col6;
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        $tablemaker="CREATE TABLE IF NOT EXISTS userlogin(
            user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
            user_first varchar(256) not null,
            user_last varchar(256) not null,
            user_email varchar(256) not null UNIQUE,
            user_uid varchar(256) not null,
            user_pwd varchar(256) not null,
        );";
        $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
        try {
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DROP TABLE ".$tablename;
            // use exec() because no results are returned
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            // $conn->prepare($sql);
            // $conn->exec($sql);
            echo "<h1><font color=red >OLD talbename = $tablename has been DELETED</font></h1>";
            }
        catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
        $conn=null;
    }

    static function _select_col_from_tablename($tablename,$col){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
        $sql="SELECT $col FROM $tablename;";
        // $sql="SELECT * FROM 'upload image';";
        echo "you select column =$col,here is its data<br>";
        
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        
        //創建global variable $fetch 對應取出的column data,fetchAll() pdo function 可以取出指定整個column
        // fetch（） 只能取出第一個record中的field，一個fetch（）或fetchAll對應一個execute(),如果大於execute的個數，那麼return false或empty array；
        // 這個會return multi dimension array
        // $GLOBALS['fetch'] = $stmt->fetchAll();
        // PDO::FETCH_COLUMN 模式，配合fetchAll(),return 一次元 associative array 對應整個column
        $colfetch=$_SESSION['fetch']=$GLOBALS['fetch']= $stmt->fetchAll(PDO::FETCH_COLUMN);
        var_dump($colfetch);
        $conn=null;
    }
    
    static function _select_from_tablename_where($tablename,$col1,$value1){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        try{
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="SELECT * FROM $tablename WHERE $col1 = ?";
            // $sql="SELECT * FROM 'upload image';";
            $stmt=$conn->prepare($sql);
            $result=$stmt->execute([
                $value1
            ]);
            var_dump($result);
            if($result == true){
                echo "you select an entire row,here is its data<br>";
                $rowfetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetch(PDO::FETCH_ASSOC);
                var_dump($rowfetch);
            }
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn=null;
    }

    static function _select_from_tablename_where2($tablename,$col1,$value1,$col2,$value2){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        try{
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="SELECT * FROM $tablename WHERE $col1 = ? AND $col2 = ?";
            // $sql="SELECT * FROM 'upload image';";
            $stmt=$conn->prepare($sql);
            $result=$stmt->execute([
                $value1,
                $value2
            ]);
            var_dump($result);
            if($result === true){
                echo "you select an entire row,here is its data<br>";
                $rowfetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetch(PDO::FETCH_ASSOC);
                var_dump($rowfetch);
            }
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn=null;
    }

    static function _select_all_from($tablename="loginpage"){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        try{
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="SELECT * FROM $tablename;";
            //$sql="SELECT * FROM 'upload image';";
            echo "you select tablename =$tablename,here is its data<br>";
            $stmt=$conn->prepare($sql);
            $result=$stmt->execute();
            var_dump($result);
            if($result === true){
                echo "you select an entire row,here is its data<br>";
                $tablefetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetchALL(PDO::FETCH_ASSOC);
                // var_dump($tablefetch);
                $i=0;
                $testarray=array_keys($tablefetch[0]);
                echo 'COLID=',implode("||",$testarray),"<br>";
                // var_dump($testarray);
                while(array_key_exists($i,$tablefetch)){
                    $j=$tablefetch[$i];
                    echo '>>>>>>',implode('||',array_values($j)),"<br>";
                    ++$i;
                }
                
            }
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn=null;
    }

    static function _fetch_table_COLID($tablename="loginpage"){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        try{
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="SELECT * FROM $tablename;";
            //$sql="SELECT * FROM 'upload image';";
            // echo "you select tablename =$tablename,here is its data<br>";
            $stmt=$conn->prepare($sql);
            $result=$stmt->execute();
            // var_dump($result);
            if($result === true){
                // echo "you select an entire row,here is its data<br>";
                $tablefetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetchALL(PDO::FETCH_ASSOC);
                // var_dump($tablefetch);
                $i=0;
                $testarray=array_keys($tablefetch[0]);
                echo "<tr class='table-danger'>";
                foreach($testarray as $value){
                    echo "<th>$value</th>";
                }
                echo "</tr>";
                // echo 'COLID=',implode("||",$testarray),"<br>";
                // var_dump($testarray);
                // while(array_key_exists($i,$tablefetch)){
                //     $j=$tablefetch[$i];
                //     echo '>>>>>>',implode('||',array_values($j)),"<br>";
                //     ++$i;
                // }
                
            }
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn=null;
    }

    static function _fetch_table_field($tablename="loginpage"){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        try{
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="SELECT * FROM $tablename;";
            //$sql="SELECT * FROM 'upload image';";
            echo "you select tablename =$tablename,here is its data<br>";
            $stmt=$conn->prepare($sql);
            $result=$stmt->execute();
            // var_dump($result);
            // if($result === true){
                // echo "you select an entire row,here is its data<br>";
                $tablefetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetchALL(PDO::FETCH_ASSOC);
                // var_dump($tablefetch);
                $i=0;
                $testarray=array_keys($tablefetch[0]);
                // echo 'COLID=',implode("||",$testarray),"<br>";
                // var_dump($testarray);
                
                while(array_key_exists($i,$tablefetch)){
                    echo "<tr>";
                    $j=$tablefetch[$i];
                    foreach($j as $value){
                        echo "<td>$value</td>";
                    }
                    echo"</tr>";
                    ++$i;
                }
                
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn=null;
    }

    static function _insert_into_values_5($tablename,$col2,$col3,$col4,$col5,$col6,$value2,$value3,$value4,$value5,$value6){
        //global $col1,$col2,$col3,$col4,$col5,$col6;
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
        try {
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO 
                        $tablename(
                                    $col2, 
                                    $col3, 
                                    $col4,
                                    $col5,
                                    $col6
                                    )
                    VALUES (
                        ?,?,?,?,?
                            )";
            $conn->prepare($sql)->execute(
                [
                $value2,
                $value3,
                $value4,
                $value5,
                $value6 
                ]
                );
            // $conn->exec($sql);
            echo "New record created successfully<br>";
            }
        catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
            $conn=null;
    }

    static function _insert_into_values_4_option($tablename,$col2,$col3,$col4,$col5,$data){
        //global $col1,$col2,$col3,$col4,$col5,$col6;
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        echo"對應的value一定要用ordered array，而不是associative array，而且要順序正確 br>";
        $data=array_values($data);
        $keyname=array_keys($data);
        $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
        try {
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO 
                        $tablename(
                            $col2, 
                            $col3, 
                            $col4,
                            $col5
                        )
                    VALUES (
                        ?,?,?,?
                        )";
            $stmt=$conn->prepare($sql);
            // foreach($data as $inputdata){
                $stmt->execute($data);
            // };
            echo "New record created successfully<br>";
            }
        catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
        $conn=null;
    }

    // 未完成//應該先學會認證authentication，之後再來更新database。
    static function _update_set_where($tablename,$col,$value,$unique_column,$unique_value){
        //global $col1,$col2,$col3,$col4,$col5,$col6;
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
        if(isset($col)){#這裡要使用另一組 update 用form 中的 input name attribute
            try {
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE $tablename SET $col = ? WHERE $unique_column = ?;";           
            // $sql = "update ".$tablename."set ".$col."=".$value."where ".$uniqe_column."=".$uniqe_value;           
            $stmt=$conn->prepare($sql);
            $stmt->execute([
                $value,
                $unique_value
            ]);
            echo "OLD record has been updated successfully<br>";
            // 更新後不能直接fetch 會產生error 需要再次用 select clause 來重新fetch。
            // $rowfetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($rowfetch);
            $sql = "SELECT * FROM $tablename WHERE $unique_column = ?;";
            $stmt=$conn->prepare($sql);
            $stmt->execute([
                $unique_value
            ]);
            $rowfetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($rowfetch);
            }
            catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
            };
        }
        $conn=null;
    }
    
    static function _update_set2_where($tablename,$col1,$value1,$col2,$value2,$unique_column,$unique_value){
        //global $col1,$col2,$col3,$col4,$col5,$col6;
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
        #這裡要使用另一組 update 用form 中的 input name attribute
        if(isset($col1)&& isset($col2))try {
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE $tablename SET $col1 = ? , $col2= ? WHERE $unique_column = ?;";           
            // $sql = "update ".$tablename."set ".$col."=".$value."where ".$uniqe_column."=".$uniqe_value;           
            $stmt=$conn->prepare($sql);
            $stmt->execute([
                $value1,
                $value2,
                $unique_value
            ]);
            echo "OLD record has been updated successfully<br>";
            // 更新後不能直接fetch 會產生error 需要再次用 select clause 來重新fetch。
            // $rowfetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($rowfetch);
            $sql = "SELECT * FROM $tablename WHERE $unique_column = ?;";
            $stmt=$conn->prepare($sql);
            $stmt->execute([
                $unique_value
            ]);
            $rowfetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($rowfetch);
            }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
            };
        $conn=null;
    }

    static function _delete_from_tablename_where($tablename,$unique_column,$unique_value){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        try{
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="SELECT * FROM $tablename WHERE $unique_column = ?";
            // $sql="SELECT * FROM 'upload image';";
            $stmt=$conn->prepare($sql);
            $result=$stmt->execute([
                $unique_value
            ]);
            echo "you delete an entire row,here is its data<br>";
            $rowfetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($rowfetch);
            $sql="DELETE FROM $tablename WHERE $unique_column = ?";
            // $sql="SELECT * FROM 'upload image';";
            $stmt=$conn->prepare($sql);
            $result=$stmt->execute([
                $unique_value
            ]);
            var_dump($result);
            if($result == true){
                echo "this entire row has been deleted.<br>";
            }
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn=null;
    }

    static function _SQL_query($query,$tablename="loginpage"){
        $dbservername="localhost";  #xampp默認的servername
        $dbusername="root";  #xampp 默認的username
        $dbpassword="";#xampp root對應的 password
        $databasename="testdatabase";#要輸入對應的database 名。
        try{
            $conn = new PDO("mysql:host=$dbservername;dbname=$databasename", $dbusername, $dbpassword);
            $conn->exec("SET CHARACTER SET utf8");#encode mode 為utf-8；
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // $sql="SELECT * FROM $tablename;";
            //$sql="SELECT * FROM 'upload image';";
            // echo "you select tablename =$tablename,here is its data<br>";
            $stmt=$conn->prepare($query);
            $result=$stmt->execute();
            // var_dump($result);
            if($result === true){
                echo "this query is valid<br>";
                $tablefetch=$_SESSION['fetch']=$GLOBALS['fetch']=$stmt->fetchALL(PDO::FETCH_ASSOC);
                // var_dump($tablefetch);
                // $i=0;
                // $testarray=array_keys($tablefetch[0]);
                // echo "<tr class='table-danger'>";
                // foreach($testarray as $value){
                    // echo "<th>$value</th>";
                // }
                // echo "</tr>";
                // echo 'COLID=',implode("||",$testarray),"<br>";
                // var_dump($testarray);
                // while(array_key_exists($i,$tablefetch)){
                //     $j=$tablefetch[$i];
                //     echo '>>>>>>',implode('||',array_values($j)),"<br>";
                //     ++$i;
                // }
                
            }
        }catch(PDOException $e){
            echo $query."is not valid sql statement" . "as <br>" . $e->getMessage();
        }
        $conn=null;
    }

}



$tablemaker="CREATE TABLE IF NOT EXISTS userlogin(
    user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_first varchar(256) not null,
    user_last varchar(256) not null,
    user_email varchar(256) not null UNIQUE,
    user_uid varchar(256) not null,
    user_pwd varchar(256) not null,
);";
?>