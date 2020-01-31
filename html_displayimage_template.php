<!DOCTYPE html>
    <head>
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
        <?php
            $URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            if(strpos($URL,'herokuapp.com')){
                // echo "<div>$URL</div>";
            }else{
                // echo "<div>$URL</div>";
            }
            if(isset($_POST) && $_POST != false){
                // var_dump($_POST);
                // echo "post <br>";
            }
            if(isset($_COOKIE) && $_COOKIE != false){
                // var_dump($_COOKIE);
                // echo 'cookie <br>';
            }
            session_start();
            if(isset($_SESSION)){
                // var_dump($_SESSION);
                // echo 'session <br>';
            }
            require_once("html_navibar_template.php");
            require_once ('login.php');
            if(!isset($_SESSION['user_id'])){
                echo "<div id='echo1'>セッションの読み込みが失敗しました、ログイン画面に戻ります</div>";
                $redirect='html_login_template.php';
                $conn->close();
                require_once ('test_header.php');
                exit();
            }
            $query = "select product_id,image_id,date_image,image_info,image_data,image_type from image
                                    where user_id = ?";
            $stmt=$conn->prepare($query);
            if(!$stmt)echo($conn->error);
            $user_id=$_SESSION['user_id'];
            $stmt->bind_param('i',$user_id);
            if(!$stmt->execute()){
                echo "<div id='echo2'>データベース接続エラー、前のページに戻ります</div>";
                $redirect='html_showallproduct_template.php';
                $conn->close();
                require_once ('test_header.php');
                exit();
            }
            $result_stmt=$stmt->get_result();
            echo "<h1 id='echo3'>サムネをクリックすると、拡大画像が表示できます</h1>";
            echo "
                <table class='table table-dark'>
                    <tr>
                        <th>
                            <span id='echo4'>商品番号</span>
                        </th>
                        <th>
                            <span id='echo5'>画像番号</span>
                        </th>
                        <th>
                            <span id='echo6'>アップロード時間</span>
                        </th>
                        <th>
                            <span id='echo7'>画像説明</span>
                        </th>
                        <th>
                            <span id='echo8'>画像ファイルタイプ</span>
                        </th>
                    </tr>";
            while($row=$result_stmt->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['product_id']."</td>";
                echo "<td>".$row['image_id']."</td>";
                echo "<td>".$row['date_image']."</td>";
                echo "<td>".$row['image_info']."</td>";
                echo "<td>".$row['image_type']."</td>";
                echo "</tr>";
                $image_id=$row['image_id'];
                # 要想用 anchor tag <a></a> pass value 用來顯示原圖
                echo "<a target='_blank' rel='noopener noreferrer' href='html_originalimage_template.php?image_id=",urlencode($image_id),     "'><img height='80' width='80 'src='data:image/jpeg;base64,".base64_encode($row["image_data"])."'/></a>";
            }
            echo "</table>";
            echo "
                <button id='button1' class='btn btn-warning'>
                    <span id='echo9'>商品番号ページに戻ります</span>
                </button>";
            $conn->close();
        ?>
        <script id='jquery_cookie' src='/jquery-cookie-master/src/jquery.cookie.js'></script>
        <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
        <script id='js' defer async type=text/javascript src='html_displayimage_template.js'></script>
    </body>
</html>
