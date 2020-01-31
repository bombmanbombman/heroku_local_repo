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
        <link id='bootstrap' type='text/css' rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
        <script id='jquery' src="jquery-3.4.1.js"></script>
        <!-- ripple effect library -->
        <script src="jquery.ripples.js"></script>
        <script id='bootstrap_js' src='bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
        <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
        <script id='jquery_cookie' src='jquery-cookie-master/src/jquery.cookie.js'></script>
        <script id='vue' src="vue.min.js"></script>
    </head>
    <body>
        <br>
        <br>
        <br>
        <?php
            $URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            if(strpos($URL,'herokuapp.com')){
                echo "<div>$URL</div>";
            }else{
                echo "<div>$URL</div>";
            }
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
            require_once('html_navibar_template.php');
            if(!isset($_SESSION['user_id'])){
                echo "session 傳送失敗<br>";
                $redirect='index.php';
                require_once ('test_header.php');
                exit();
            }
            require_once('login.php');
            $user_id=$_SESSION['user_id'];
            #先fetch各個 data
            $query='select a.user_email,a.user_phone,b.user_icon from user a 
            inner join user_icon b on(a.user_id=b.user_icon_id) 
            where a.user_id= '.$user_id;
            $stmt=$conn->query($query);
            if(!$stmt)echo $conn->error.'<br>';
            $row=$stmt->fetch_assoc();
            $user_email=$row['user_email'];
            $user_phone=$row['user_phone'];
            $user_icon=$row['user_icon'];
        ?>
        <hr>
        <h6 id='echo1'>電話番号とメールボックスはパスワードが忘れたとき、パスワードをリセットすることに使います。</h6>
        <form method='post' action='html_adduserdetail_submit.php' enctype='multipart/form-data'>
            <label id='echo2'>あなたのメールボックスを入力してください、＠のマークは必ずつけてください。</label>
            <br>
            <input type='eamil' style='width:300px;' value='<?php echo $user_email?>' name='user_email'>
            <br>
            <label id='echo3'>あなたの電話番号を入力してください、ハイフンは入れないでください</label>
            <br>
            <input type='tel' value='<?php echo $user_phone?>' pattern="^\d{11}$" 
        maxlength ='11' name='user_phone' >
            <br>
            <?php
                if(isset($_SESSION['post_error_message'])){
                    echo $_SESSION['post_error_message']."<br>";
                }else {echo "<br><br>";}
            ?>
            <label id='echo4'>アバター画像をアップロード、または更新する</label>
            <br>
            <input type='file' name='user_icon'>
            <br>
            <br>
            <input id='value1' class='btn btn-warning' type='submit' value='決定'>
        </form>
        <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
        <script id='js' defer async type=text/javascript src='html_adduserdetail_template.js'></script>
    </body>
</html>







































