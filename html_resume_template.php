<html>
    <head>
        <meta content='text/html;charset=utf-8' http-equiv='Content-Type'>
        <meta content='utf-8' http-equiv='encoding'>
        <meta http-equiv='Content-Security-Policy' content='upgrade-insecure-requests'>
        <title>new sale page</title>
        <link id='bootstrap' type='text/css' rel='stylesheet' href='bootstrap-4.4.1-dist/css/bootstrap.min.css'>
        <script id='jquery' src='jquery-3.4.1.js'></script>
        <!-- ripple effect library -->
        <script src='jquery.ripples.js'></script>
        <script id='bootstrap_js' src='bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
        <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
        <script id='jquery_cookie' src='jquery-cookie-master/src/jquery.cookie.js'></script>
        <script id='vue' src='vue.min.js'></script>
        <!-- firefox date support plugin -->
        <script id='polyfiller'src='polyfiller.js'></script>
    </head>
    <body>
        <?php
            $URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            if(strpos($URL,'herokuapp.com')){
                // echo "<div>$URL</div>";
            }else{
                // echo "<div>$URL</div>";
            }
            if(isset($_POST) && $_POST != false){
                // var_dump($_POST);
                if(isset($_POST['date_sold'])&&$_POST['date_sold']==null){
                    date_default_timezone_set('Asia/Shanghai');
                    $current_time=date('Y-m-d H:i:s');
                    $_POST['date_sold']=$current_time;
                    // echo "<div>var_dump($_POST[date_sold]) null</div>";
                }else{
                    if(isset($_POST['time_sold'])&&$_POST['time_sold']!=null){
                        $_POST['date_sold']=$_POST['date_sold']." ".$_POST['time_sold'].":00";
                    }else{
                        date_default_timezone_set('Asia/Shanghai');
                        $current_time=date('Y-m-d H:i:s');
                        $_POST['date_sold']=$current_time;
                        // echo "<div>var_dump($_POST[date_sold]) notnull</div>";
                    }
                    // echo "<div>$_POST[date_sold]</div>";
                    // echo var_dump($_POST['date_sold']);
                }
                // echo "post <br>";
            }
            if(isset($_COOKIE)){
                // var_dump($_COOKIE);
                // echo 'cookie <br>';
            }
            session_start();
            if(isset($_SESSION)){
                // var_dump($_SESSION);
                // echo 'session <br>';
            }
            require_once("html_navibar_template.php");
            if(!isset($_SESSION['user_id'])){
                echo "<div id='echo1'>セッションの読み込みが失敗しました、ログイン画面に戻ります</  div>";
                $redirect='html_login_template.php';
                require_once ('test_header.php');
                exit();
            }

        ?>
        <div id='image'> 
          <img src='apparel/resume1.jpg' style='height:791px;width:627px;' alt='resume1'/>
          <img src='apparel/resume2.jpg' style='height:791px;width:627px;' alt='resume2'/>
        </div>
          
        <?php
          $file = 'apparel/resume.doc';
          function DownloadFile($file) { // $file = include path
            if(file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: ' . mime_content_type($file));
                // header('Content-Disposition: inline; filename="'.basename($file).'"');
                header('Content-Disposition: attachment; filename="'.basename($file).'"' );
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                exit;
            }
          }
          if(isset($_GET['download'])){
            DownloadFile($file);
          }
        ?>
        <form method="get" action="apparel/resume.doc">
            <button class='btn btn-warning' type="submit">レジュメをダウンロードする</button>
        </form>
        <!-- <a id='download' class='btn btn-success' href='html_resume_template.php?download=true'>レジュメをダウンロードする</a> -->
        <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
        <script id='js' defer async type=text/javascript src="html_resume_template.js"></script>
    </body>
</html> 

