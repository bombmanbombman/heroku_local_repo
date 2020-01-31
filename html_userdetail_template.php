<!DOCTYPE html>
    <head>
        <style>
            a.button {
                -webkit-appearance: button;
                -moz-appearance: button;
                appearance: button;
                text-decoration: none;
                color: initial;
            }
        </style>
        <title>user detail page</title>
        <link id='bootstrap' type='text/css' rel="stylesheet"   href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
        <script id='jquery' src="jquery-3.4.1.js"></script>
        <!-- ripple effect library -->
        <script src="jquery.ripples.js"></script>
        <script id='bootstrap_js' src='bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
        <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
        <script id='jquery_cookie' src='jquery-cookie-master/src/jquery.cookie.js'></script>
        <script id='vue' src="vue.min.js"></script>
    </head>
    <body>
        <?php
            $URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            // echo "<div>$URL</div>";
            // session_start();
            // if(isset($_POST) && $_POST != false){
            //   var_dump($_POST);
            //   echo "post <br>";
            // }
            // if(isset($_COOKIE)){
            //   var_dump($_COOKIE);
            // if(isset($_COOKIE['user_id'])){
                // $_SESSION['user_id']=$_COOKIE['user_id'];
            // // echo 'cookie <br>';
            if(!isset($_SESSION['user_id'])){
            }else{
                if(strpos($URL,'herokuapp.com')){
                    header("Location: https://bombmanbombman-project1.herokuapp.com");
                    // echo '<meta http-equiv="refresh" content="0; url=https://bombmanbombman-project1.herokuapp.com/" />';
                }elseif(strpos($URL,'host:3000')){
                    header("Location: https://localhost:3000/index.php");
                    // echo '<meta http-equiv="refresh" content="0; url=https://localhost:3000/index.php" />';
                }elseif(strpos($URL,'host:8012')){
                    header("Location: https://localhost:8012/laravelFolder/resources/views/learning_php/html_login_template.php");
                    // echo '<meta http-equiv="refresh" content="0; url=https://localhost:8012/laravelFolder/resources/views/learning_php/html_login_template.php" />';
                }
            }
            echo "<div>$URL</div>";
            session_start();
            if(isset($_POST) && $_POST != false){
                var_dump($_POST);
                echo "post <br>";
            }
            if(isset($_COOKIE)){
                var_dump($_COOKIE);
                echo 'cookie <br>';
            }
            if(isset($_SESSION)){
                var_dump($_SESSION);
                echo 'session <br>';
            }

            require_once("html_navibar_template.php");

            if(!isset($_SESSION['user_id'])){
                echo "session 傳送失敗<br>";
                $redirect='html_login_template.php';
                require_once ('test_header.php');
                exit();
            }
            require_once('login.php');
            $user_id=$_SESSION['user_id'];
            $query = 'select user_name,user_email,user_phone from user 
                where user_id ='.$user_id;
            $stmt=$conn->query($query);
            if(!$stmt)echo($conn->error);
            $row=$stmt->fetch_assoc();
            $user_name=$row['user_name'];
            $user_email=$row['user_email'];
            $user_phone=$row['user_phone'];
            // var_dump($user_name);
            // var_dump($user_email);
            // var_dump($user_phone);
            require_once('login.php');
            $query1 = "select user_icon from user_icon 
                where user_icon_id =".$user_id;
            $stmt1=$conn->query($query1);
            if(!$stmt1)echo $conn->error."<br>";
            $row=$stmt1->fetch_assoc();
            $user_icon=$row['user_icon'];
            echo "
                <div>
                    <span id='echo1'>歡迎用戶</span>
                    <var>$user_name</var> 
                    <span id='echo2'>回到本站。</span>
                </div>
                ";
            if($user_icon != null){
                echo '<img withd="80" height ="80" src="data:image/jpeg;base64,'.base64_encode($user_icon).'"/><br>';
            }else {
                echo "<label id='echo3'>默認的頭像</label>";
                $no_icon = file_get_contents('C:/xampp/htdocs/laravelFolder/resources/views/learning_php/upload_compress/no_face.png');
                echo '<img withd="80" height ="80" src="data:image/jpeg;base64,'.base64_encode($no_icon).'"/><br>';
            }
            if($user_phone != null && $user_phone != '00000000000'){
                // $_SESSION['user_phone']=$user_phone;
                echo "<div><span id='echo4'>您的電話是 </span><var>$user_phone</var></div>";
            }else echo "<div id='echo5'>您還未輸入電話</div>";
            if($user_email!= null){
                // $_SESSION['user_email']=$user_email;
                echo "<div><span id='echo6'>您的郵箱是 </span><var>$user_email</var></div>";
            }else echo "<div id='echo7'>您還未輸入郵箱</div>";

            $query ='select product_id from product 
                        where user_id ='.$user_id;
            $stmt=$conn->prepare($query);
            if(!$stmt)echo($conn->error);
            if(!$stmt->execute())die("select product_id failed");
            $result_stmt=$stmt->get_result();
            // var_dump($result_stmt);
            $num_rows=$result_stmt->num_rows;
            // var_dump($num_rows===0);
            // echo '<br>';

            if($num_rows!==0){
                $progress2=true;
                $conn->close();
            }

            // if(isset($progress1)&&$progress1===true){
        ?>

        <button id='button1'><h4 id='echo8'>補充修改用戶詳細信息</h4></button>
        <br>
        <br>
        <br>
        <button id='button2'><h4 id='echo9'>添加新的貨品，輸入貨品基本信息</h4></button>
        <br>
        <br>
        <br>
        <?php
            if(isset($progress2)&&$progress2===true){
                // var_dump($progress2);
                // var_dump($_SESSION['user_id']);
                echo "<button id='button3'><h4 id='echo10'>進入全貨號管理頁面</h1></button>";
            }
        ?>
        <script id='ref' defer async type='text/javascript'  src='html_template.js'></script>
        <script id='js' defer async type='text/javascript'  src="html_userdetail_template.js"></script>
    </body>
</html>

















































