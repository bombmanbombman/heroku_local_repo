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
                echo "<div id='echo1'>セッションの読み込みが失敗しました、ログイン画面に戻ります</div>";
                $redirect='html_login_template.php';
                require_once ('test_header.php');
                exit();
            }
            require_once("login.php");
            $user_id=$_SESSION['user_id'];
            #僅僅對 showallproduct.php頁面 搜索而來的進行filter.
            if(isset($_POST['product_id_for_sale'])&&$_POST['product_id_for_sale']!=0){
                $_SESSION['product_id_for_sale']=$_POST['product_id_for_sale'];
            }
            #尋找product_id_for_sale是否存在product table中 一共15行。
            $query ='select product_id from product where user_id ='.$user_id;
            $result=$conn->query($query);
            $rows=$result->fetch_all(MYSQLI_NUM);
            $all_product_id_in_product=array();
            foreach($rows as $subarray1){
                foreach($subarray1 as $value){
                    $all_product_id_in_product[]=$value;
                }
            }
            // var_dump($all_product_id_in_product);
            if(!in_array($_SESSION['product_id_for_sale'],$all_product_id_in_product)){
                echo"<div id='echo2'>商品番号が存在しないため、前のページに戻ります</div>";
                unset($_SESSION['product_id_for_sale']);
                $redirect='html_showallproduct_template.php';
                require_once ("test_header.php");
            }
            #顯示這個貨品的product table中的內容
            $query='select product_id,buy_place,product_info,product_detail from product 
                                where user_id = '.$user_id.' and product_id = '.$_SESSION['product_id_for_sale'];
            $stmt=$conn->query($query);
            if(!$stmt)echo($conn->error);
            echo "
            <table class='table table-dark'>
                <tr>
                    <th scope='col'>
                        <span id='echo3'>商品番号</span>
                    </th>
                    <th scope='col'>
                        <span id='echo4'>仕入れ場所</span>
                    </th>
                    <th scope='col'>
                        <span id='echo5'>商品名</span>
                    </th>
                    <th scope='col'>
                        <span id='echo6'>詳細情報</span>
                    </th>
                </tr>";
            while($row=$stmt->fetch_assoc()){
                echo"
                <tr>
                    <td scope='row'>$row[product_id]</td>
                    <td scope='row'>$row[buy_place]</td>
                    <td scope='row'>$row[product_info]</td>
                    <td scope='row'>$row[product_detail]</td>
                </tr>
                ";
            }
            echo "</table class='table table-dark'>";
            #尋找product_id_for_sale是否也存在與purchase table中  一共18行 
            $query ='select product_id from purchase 
                                where user_id ='.$user_id;
            $stmt=$conn->query($query);
            if(!$stmt)echo($conn->error);
            $rows=$stmt->fetch_all(MYSQLI_NUM);
            $all_product_id_in_purchase=array();
            foreach($rows as $subarray1){
                foreach($subarray1 as $value){
                    $all_product_id_in_purchase[]=$value;
                }
            }
            // var_dump($all_product_id_in_purchase);
            if(in_array($_SESSION['product_id_for_sale'],$all_product_id_in_purchase)){
                echo"<div id='echo7'>仕入れ記録があり</div>";
                $progress1=true;
            }else{
                echo "<h4 id='echo8'>仕入れ記録がありません、はじめの仕入れ記録を作成してください</h4><br>";
                unset($_SESSION['product_id_for_sale']);
                $redirect='html_showallproduct_template.php';
                $wait_time=1;
                require_once('test_header.php');
            }
            #尋找product_id_for_sale是否也存在與sale table中  一共18行 
            $query ='select product_id from sale 
                                where user_id ='.$user_id;
            $stmt=$conn->query($query);
            if(!$stmt)echo($conn->error);
            $rows=$stmt->fetch_all(MYSQLI_NUM);
            $all_product_id_in_sale=array();
            foreach($rows as $subarray1){
                foreach($subarray1 as $value){
                    $all_product_id_in_sale[]=$value;
                }
            }
            // var_dump($all_product_id_in_sale);
            if(in_array($_SESSION['product_id_for_sale'],$all_product_id_in_sale)){
                echo"<div id='echo9'>出荷記録があり</div><br>";
                $progress2=true;
            }else{
                echo "<div id='echo10'>出荷記録がありません</div>";
            }

            #如果已經進過貨，那麼顯示更詳細的內容 顯示最近期的10筆購入記錄  26 line
            if(isset($progress1)&&$progress1===true){
                $product_id=$_SESSION['product_id_for_sale'];
                $query = 'select b.purchase_id,
                b.date_purchase,b.purchase_cost,b.purchase_number,purchase_size 
                from product a 
                inner join purchase b on(a.product_id = b.product_id) 
                where a.user_id = '.$user_id.' and a.product_id = '.$product_id.
                ' order by b.date_purchase desc 
                limit 10';
                $stmt=$conn->query($query);
                if(!$stmt)echo($conn->error);
                echo "
                    <hr>
                    <label id='echo11'>最近10件仕入れ記録</label><br>
                    <table class='table table-dark'>
                        <tr>
                            <th scope='col'>
                                <span id='echo12'>仕入れ番号</span>
                            </th>
                            <th scope='col'>
                                <span id='echo13'>仕入れ時間</span>
                            </th>
                            <th scope='col'>
                                <span id='echo14'>仕入れ価格</span>
                            </th>
                            <th scope='col'>
                                <span id='echo15'>仕入れ数</span>
                            </th>
                            <th scope='col'>
                                <span id='echo16'>仕入れサイズ</span>
                            </th>
                        </tr>";
                while($row=$stmt->fetch_assoc()){
                    echo "
                        <tr>
                            <td scope='row'>$row[purchase_id]</td>
                            <td scope='row'>$row[date_purchase]</td>
                            <td scope='row'>$row[purchase_cost]</td>
                            <td scope='row'>$row[purchase_number]</td>
                            <td scope='row'>$row[purchase_size]</td>
                        </tr>
                    ";
                }
                #如果已經出售過，顯示最近10筆交易記錄   27 line
                echo "</table class='table table-dark'>";
                if(isset($progress2)&&$progress2===true){
                    $query = 'select b.sale_id,
                    b.date_sold,b.price,b.customer_info,b.sold_size 
                    from product a 
                    inner join sale b on(a.product_id = b.product_id) 
                    where a.user_id = '.$user_id.' and a.product_id = '.$product_id.
                    ' order by b.date_sold desc 
                    limit 10';
                    $stmt=$conn->query($query);
                    if(!$stmt)echo($conn->error);
                    echo "
                        <hr>
                        <label id='echo17'>最近10件出荷記録</label>
                        <br>
                        <table class='table table-dark'>
                            <tr>
                                <th scope='col'>
                                    <span id='echo18'>出荷番号</span>
                                </th>
                                <th scope='col'>
                                    <span id='echo19'>出荷時間</span>
                                </th>
                                <th scope='col'>
                                    <span id='echo20'>出荷価格</span>
                                </th>
                                <th scope='col'>
                                    <span id='echo21'>客の情報</span>
                                </th>
                                <th scope='col'>
                                    <span id='echo22'>売れたサイズ</span>
                                </th>
                            </tr>
                    ";
                    while($row=$stmt->fetch_assoc()){
                        echo"
                            <tr>
                                <td scope='row'>$row[sale_id]</td>
                                <td scope='row'>$row[date_sold]</td>
                                <td scope='row'>$row[price]</td>
                                <td scope='row'>$row[customer_info]</td>
                                <td scope='row'>$row[sold_size]</td>
                            </tr>
                        ";
                    }
                    echo "</table class='table table-dark'>";
                }
            }

            date_default_timezone_set('Asia/Shanghai');
            $current_time=date('Y-m-d/TH:i:s');
            // echo "<div>$current_time</div>"
        ?>
        <br>
        <br>
        <br>

        <form method="post" action="html_submitredirect_template.php">
            <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>"> -->
            <div class='form-group'>
                <label class='form-text text-muted' id='echo23'>出荷時間を入力してください、未記入や一部記入の場合は自動的に現在時刻を入力されます</label>
                <!-- firefox date support plugin -->
                <script>
                    webshims.setOptions("forms-ext", {types: "date"});
                    webshims.polyfill("forms forms-ext");
                </script>
                <!-- <input type="datetime-local" name="date_sold" size="40" value=""><br> -->
                <input class='form-control' id='datetime-local' type="datetime-local" name="date_sold" size="40"     value="">
            </div>
            <!-- <input class='form-control' type="date" name="date_sold" ><br> -->
            <div class='form-group'>
                <label class='form-text text-muted' id='echo24'>商品あたり売り値段</label>
                <input type="number" name="price" min='1' max="99999999" size="40" required>
                <span id='echo26'>円/一着</span>
            </div>
            <div class='form-group'>
                <input type="hidden" name='product_id_for_sale' value='0'>
                <label class='form-text text-muted' id='echo25'>売るサイズ　オプション</label>
                <select class='form-control' name='sold_size'>
                    <option id='echo28' value='' >サイズを選択してください</option>
                    <option value='XXXS'>XXXS</option>
                    <option value='XXS'>XXS</option>
                    <option value='XS'>XS</option>
                    <option value='S'>S</option>
                    <option value='M'>M</option>
                    <option value='L'>L</option>
                    <option value='XL'>XL</option>
                    <option value='XXL'>XXL</option>
                </select>
            </div>
            <div class='form-group'>
            <label class='form-text text-muted' id='echo27'>客の情報　オプション</label>
            <textarea class='form-control form-control-sm' name='customer_info' maxlength='255' rows='8' cols='50' value=''></textarea>
            </div>
            <input type="submit"class='btn btn-success' id='value2' value="出荷記録を作る">
        </form>
        <!--用於刪除session 中的 product_id_for_sale-->
        <!-- <form action="html_showallproduct_template.php" method="post">
            <input type="submit" class='btn btn-warning' id='value3' value="回到所有貨號頁面" 
            name="unset_product_id_for_sale">
        </form> -->
        <a class='btn btn-warning' id='echo80' href='html_showallproduct_template.php'>
            商品番号ページに戻ります
        </a>
        <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
        <script id='js' defer async type=text/javascript src="html_newsale_template.js"></script>
    </body>
</html> 

