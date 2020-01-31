<!DOCTYPE html>
    <head>
        <title>new purchase page</title>
        <style>
            #map {
                display: block;
                margin-left: auto;
                margin-right: auto;
                height: 50%;
                width: 80%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
        <link id='bootstrap' type='text/css' rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
        <script id='jquery' src="jquery-3.4.1.js"></script>
        <!-- ripple effect library -->
        <script src="jquery.ripples.js"></script>
        <script id='bootstrap_js' src='bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
        <script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
        <script id='jquery_cookie' src='jquery-cookie-master/src/jquery.cookie.js'></script>
        <script id='vue' src="vue.min.js"></script>
        <!-- firefox date support plugin -->
        <script src='polyfiller.js'></script>
    </head>
    <body>
        <?php
            $URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            if(strpos($URL,'herokuapp.com')){
                // echo "<div>$URL</div>";
            }else{
                // echo "<div>$URL</div>";
            }
            session_start();
            if(isset($_POST) && $_POST != false){
                // var_dump($_POST);
                // echo "post <br>";
            }
            if(isset($_COOKIE) && $_COOKIE != false){
                // var_dump($_COOKIE);
                // echo 'cookie <br>';
            }
            if(isset($_SESSION)  && $_SESSION != false){
                // var_dump($_SESSION);
                // echo 'session <br>';
            }
            /**sending js cookie file */
            require_once("login.php");
            if(isset($_POST['product_id_for_purchase'])){
                $_SESSION['product_id_for_purchase']=$_POST['product_id_for_purchase'];
            }
            $user_id=$_SESSION['user_id'];
            $query='select latitude,longitude from product 
                where user_id = '.$user_id.' and product_id = '.$_SESSION['product_id_for_purchase'];
            $stmt=$conn->query($query);
            if(!$stmt)echo($conn->error);
            while($row=$stmt->fetch_assoc()){
                // echo $row['latitude']."<br>";
                // echo $row['longitude']."<br>";
                // var_dump(setcookie('latitude',$row['latitude'],time()+120,'/'));
                setcookie('latitude',$row['latitude'],time()+120,'/');
                // var_dump(setcookie('longitude',$row['longitude'],time()+120,'/'));
                setcookie('longitude',$row['longitude'],time()+120,'/');
            }
            require_once("html_navibar_template.php");
            #google map 部分
            echo"
                <div id='map' ></div>
            ";
            if(!isset($_SESSION['user_id'])){
                echo "<div id='echo1'>session 傳送失敗</div>";
                $redirect='html_login_template.php';
                require_once ('test_header.php');
                exit();
            }
            #僅僅對 showallproduct.php頁面 搜索而來的進行filter.
            if(isset($_POST['product_id_for_purchase'])&&$_POST['product_id_for_purchase']!=0){
                $_SESSION['product_id_for_purchase']=$_POST['product_id_for_purchase'];
            }
            #尋找product_id_for_purchase是否存在product table class='table table-dark'中 一共15行。
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
            if(!in_array($_SESSION['product_id_for_purchase'],$all_product_id_in_product)){
                echo"<div id='echo2'>這個貨號不存在，請輸入有效的貨號</div>";
                unset($_SESSION['product_id_for_purchase']);
                $redirect='html_showallproduct_template.php';
                require_once ("test_header.php");
            }
            #顯示這個貨品的product table class='table table-dark'中的內容 一共 15 line
            $query='select product_id,buy_place,product_info,product_detail,latitude,longitude from product 
                where user_id = '.$user_id.' and product_id = '.$_SESSION['product_id_for_purchase'];
            $stmt=$conn->query($query);
            if(!$stmt)echo($conn->error);
            echo "
                <table class='table table-dark'>
                    <tr>
                        <th>
                            <span id='echo3'>貨號</span>
                        </th>
                        <th>
                            <span id='echo4'>進貨地點</span>
                        </th>
                        <th>
                            <span id='echo5'>貨品簡介</span>
                        </th>
                        <th>
                            <span id='echo6'>貨品詳細</span>
                        </th>
                    </tr>";
            while($row=$stmt->fetch_assoc()){
                echo"
                <tr>
                    <td>$row[product_id]</td>
                    <td>$row[buy_place]</td>
                    <td>$row[product_info]</td>
                    <td>$row[product_detail]</td>
                </tr>
                ";
            }
            echo "</table class='table table-dark'>";
            #尋找product_id_for_purchase是否也存在與purchase table class='table table-dark'中  一共18行 
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
            if(in_array($_SESSION['product_id_for_purchase'],$all_product_id_in_purchase)){
                echo"<div id='echo7'>已經對這個貨號進過貨。</div>";
                $progress1=true;
            }else{
                echo "<div id='echo8'>還沒有對這個貨號進過貨</div>";
            }
            #尋找product_id_for_purchase是否也存在與sale table class='table table-dark'中  一共18行 
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
            if(in_array($_SESSION['product_id_for_purchase'],$all_product_id_in_sale)){
                echo"<div id='echo9'>這個貨號有出售記錄。</div>";
                $progress2=true;
            }else{
                echo "<div id='echo10'>這個貨號還沒有成交過。</div>";
            }

            #如果已經進過貨，那麼顯示更詳細的內容 顯示最近期的10筆購入記錄  26 line
            if(isset($progress1)&&$progress1===true){
                $product_id=$_SESSION['product_id_for_purchase'];
                $query = 'select b.purchase_id,
                b.date_purchase,b.purchase_cost,b.purchase_number,purchase_size 
                from product a 
                inner join purchase b on(a.product_id = b.product_id) 
                where a.user_id = '.$user_id.' and a.product_id = '.$product_id.
                ' order by b.date_purchase desc 
                limit 10';
                $stmt=$conn->query($query);
                if(!$stmt)echo($conn->error);
                echo "<br>
                <label id='echo11'>進貨記錄，僅僅顯示最近的10筆</label><br>
                <table class='table table-dark'>
                    <tr>
                        <th>
                            <span id='echo12'>進貨編號</span>
                        </th>
                        <th>
                            <span id='echo13'>進貨日期</span>
                        </th>
                        <th>
                            <span id='echo14'>進貨價格</>
                        </th>
                        <th>
                            <span id='echo15'>進貨數量</span>
                        </th>
                        <th>
                            <span id='echo16'>進貨尺碼</span>
                        </th>
                    </tr>";
                while($row=$stmt->fetch_assoc()){
                    echo "
                    <tr>
                        <th>$row[purchase_id]</th>
                        <th>$row[date_purchase]</th>
                        <th>$row[purchase_cost]</th>
                        <th>$row[purchase_number]</th>
                        <th>$row[purchase_size]</th>
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
                    echo "<br>
                    <label id='echo17'>出售記錄，僅僅顯示最近的10筆</label><br>
                    <table class='table table-dark'>
                        <tr>
                            <th scope='col'>
                                <span id='echo18'>出售編號</span>
                            </th>
                            <th scope='col'>
                                <span id='echo19'>出售日期</span>
                            </th>
                            <th scope='col'>
                                <span id='echo20'>出售價格</span>
                            </th>
                            <th scope='col'>
                                <span id='echo21'>客戶描述</span>
                            </th>
                            <th scope='col'>
                                <span id='echo22'>售出尺碼</span>
                            </th>
                        </tr>";
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
        ?>
        <br>
        <br>
        <br>
        <form method="post" action="html_submitredirect_template.php">
            <!-- <form method="post" action=""> -->
            <div class='form-group'>
                <script id='webshims'>
                    // webshims.setOptions("forms-ext", {types: "date"});
                    // webshims.polyfill("forms forms-ext");
                </script>
                <label class='form-text text-muted' id='echo23'>進貨的具體時間,如果為空，自動載入當前時間</label>
                <input class='form-control' id='datetime-local'type="datetime-local" name="date_purchase" size="40" value=''>
            </div>
            <div class='form-group'>
                <label class='form-text text-muted'id='echo24'>一件的入貨價格</label>
                <input type="number" name="purchase_cost" min='1' max="99999999" size="40" required>
            <span id='echo25'>元/件</span>
            </div>
            <div class='form-group'>
                <label class='form-text text-muted' id='echo26'>這個商品入貨了幾件</label>
                <input type="number" name="purchase_number" min='1' max="99999999" size="40"    required>
                <span id='echo27'>件</span>
            </div>
            <div class='form-group'>
                <input type="hidden" name='product_id_for_purchase' value='0'>
                <label class='form-text text-muted' id='echo28'>尺碼（選填）</label>
                <select class='form-control' name='purchase_size'>
                    <option id='value1' value=''>新選擇尺碼</option>
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
            <input type="submit" class='btn btn-info' id='value2'value="記錄這次的進貨数据。">
        </form>
        <br>
        <br>
        <!--用於刪除session 中的 product_id_for_purchase-->
        <!-- <form action="html_showallproduct_template.php" method="post">
            <input type="submit" class='btn btn-warning' id='value3'value="回到所有貨號頁面" 
            name="unset_product_id_for_purchase">
        </form> -->
        <a class='btn btn-warning' id='echo80' href='html_showallproduct_template.php'>
            回到所有貨號頁面
        </a>
        <!-- <script id='google_api_js'src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAehEZQIPxSSrInvV-wg9MZperouR5Ya5c&language=ja&callback=initMap" async defer></script> -->
        <script id='ref' defer async type='text/javascript' src='html_template.js'></script>
        <script id='js' defer async type='text/javascript' src='html_newpurchase_template.js'></script>
        <section id='google_map_js'>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAehEZQIPxSSrInvV-wg9MZperouR5Ya5c&region=JP&language=ja&callback=initMap"" async defer></script>
            <!-- <script id='google_api_js' src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5lki3Wn7GU8gZllmCyWc9VgkVDrH-_OA&language=ja&callback=initMap" async defer></script> -->
        <!-- <script async defer src='google_map.js'></script> -->
        </section>
        <noscript>please do not turn off javascript</noscript>
    </body>
</html>
