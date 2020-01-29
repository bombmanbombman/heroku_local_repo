<?php
    session_start();
    // var_dump($_SESSION);
    var_dump($_POST);
    require_once('html_navibar_template.php');
    if(!isset($_SESSION['user_id'])){
        echo "session 傳送失敗<br>";
        $redirect='index.php';
        require_once ('test_header.php');
        exit();
    }

    if(isset($_POST['user_email'])||isset($new_user_phone)||isset($_FILES['user_icon'])){
        require_once('login.php');
        $user_id=$_SESSION['user_id'];
        #先fetch database中的原來數據  9line
        $query='select a.user_email,a.user_phone,b.user_icon from user a 
        inner join user_icon b on(a.user_id=b.user_icon_id) 
        where a.user_id= '.$user_id;
        $stmt=$conn->query($query);
        if(!$stmt) $_SESSION['post_error_message']=$conn->error.'<br>';
        $row=$stmt->fetch_assoc();
        $old_user_email=$row['user_email'];
        $old_user_phone=$row['user_phone'];
        $user_icon=$row['user_icon'];
        var_dump($old_user_email);
        var_dump($old_user_phone);
        #更新电话 部分  18 line
        if(isset($_POST['user_phone'])){
            $new_user_phone=$_POST['user_phone'];
            if($new_user_phone!=$old_user_phone && substr($new_user_phone,0,1)==0){
                $query= 'update user set user_phone ='.$new_user_phone.' 
                    where user_id = '.$user_id;
                $stmt=$conn->query($query);
                if(!$stmt){
                    $_SESSION['post_error_message']=$conn->error."這個電話號碼已經被別人登錄過了，請選擇其他號碼<br>";
                    echo $_SESSION['post_error_message']."32<br>";
                    header('location:html_adduserdetail_template.php');
                    exit();
                }
                $query = "update user set user_phone=lpad( user_phone ,11,'0') 
                    where char_length(user_phone)<=11 and user_id = ".$user_id;
                $_SESSION['query']=$query;
                $stmt=$conn->query($query);
                if(!$stmt){
                    $_SESSION['post_error_message']=$conn->error."這個電話號碼已經被別人登錄過了，請選擇其他號碼<br>";
                    echo $_SESSION['post_error_message']."32<br>";
                    header('location:html_adduserdetail_template.php');
                    exit();
                }
            }
            if($new_user_phone!=$old_user_phone && substr($new_user_phone,0,1)!=0){
                $query = 'update user set user_phone = '.$new_user_phone.'  
                    where user_id = '.$user_id;
                $stmt=$conn->query($query);
                if(!$stmt){
                    $_SESSION['post_error_message']=$conn->error."這個電話號碼已經被別人登錄過了，請選擇其他號碼<br>";
                    echo $_SESSION['post_error_message']."44<br>";
                    header('location:html_adduserdetail_template.php');
                    exit();
                }
            }
        }
        if($_POST['user_email']!=null&&$_POST['user_email']!=$old_user_email){
            $user_email = double_check_input($conn,$_POST['user_email']);
            var_dump($user_email);
            $query = 'update user set user_email = \''.$user_email.'\'  
                where user_id = '.$user_id;
            $_SESSION['query']=$query;
            $stmt=$conn->query($query);
            if(!$stmt){$_SESSION['post_error_message']=$conn->error."這個郵箱地址已經被別人登錄過了，請選擇其他郵箱<br>";
                echo $_SESSION['post_error_message']."<br>";
                header('location:html_adduserdetail_template.php');
                    exit();
            }
        }
        #這裡開始 是插入圖片部分檢驗 共 69 line
        if(file_exists($_FILES['user_icon']['tmp_name'])&&$_FILES['user_icon'] != null){
            if(is_base64($_FILES['user_icon']['tmp_name'])){
                $_SESSION['post_error_message']='這不是圖片文件，請上傳圖片文件。';
                $redirect='html_adduserdetail_template.php';
                echo "74";
                require_once('test_header.php');
            }
            #檢驗圖片格式 共62 line
            if(isset($_FILES['user_icon'])){
                // Get Image Dimension
                $fileinfo = @getimagesize($_FILES["user_icon"]["tmp_name"]);
                $width = $fileinfo[0];
                $height = $fileinfo[1];
                $allowed_image_extension = array(
                    "png",
                    "jpg",
                    "jpeg"
                );
                // Get image file extension
                $file_extension = pathinfo($_FILES["user_icon"]["name"], PATHINFO_EXTENSION);
                // Validate file input to check if is not empty
                if (! file_exists($_FILES["user_icon"]["tmp_name"])) {
                    $response = array(
                        "type" => "error",
                        "message" => "剛剛的文件為空文件，請再試一次."
                    );
                }    
                // Validate file input to check if is with valid extension
                if (! in_array($file_extension, $allowed_image_extension)) {
                    $response = array(
                        "type" => "error",
                        "message" => "文件格式不對，只允許PNG,JPEG格式的圖片。" 
                    );
                }    
                // Validate image file size
                //記得要在php.ini中 設置 upload_max_filesize，post_max_size，默認只有8mb；
                if (($_FILES["user_icon"]["size"] > 15000000)) {
                    $response = array(
                        "type" => "error",
                        "message" => "圖片文件太大，只允許15MB以下。"
                    );
                }    
                // Validate image file dimension
                if ($width > "3024" || $height > "3024") {
                    $response = array(
                        "type" => "error",
                        "message" => "圖片的解析度太高，請上傳小於3000*3000的圖片"
                    );
                } 
                // else {
                        // $target = "image/" . basename($_FILES["user_icon"]["name"]);
                        // if (move_uploaded_file($_FILES["user_icon"]["tmp_name"], $target)) {
                                // $response = array(
                                        // "type" => "success",
                                        // "message" => "圖片保存到服務器的文件夾中."
                                // );
                        // } else {
                                // $response = array(
                                        // "type" => "error",
                                        // "message" => "出現了未知的原因."
                                // );
                        // }
                // }
                if(isset($response['message'])){
                    $_SESSION['post_error_message']=$response['message'];
                    echo $_SESSION['post_error_message']."128<br>";
                    header('location:html_adduserdetail_template.php');
                    exit();
                }
            }
            $query= 'delete from user_icon where user_icon_id = '.$user_id;
            $stmt=$conn->query($query);
            if(!$stmt){
                $_SESSION['post_error_message']=$conn->error;
                echo $_SESSION['post_error_message'];
                require_once('test_header.php');
                exit();
            }

            // $query = 'delete from user_icon
            //             where user_icon_id = ?';
            // $user_icon_id = $user_id;
            // $stmt=$conn->prepare($query);
            // if(!$stmt){
            //   $_SESSION['post_error_message']=$conn->error."update query failed 回到用戶頁面";
            //   require_once('test_header.php');
            //   exit();
            // }
            // $stmt->bind_param('i',$user_icon_id);
            // if(!$stmt->execute()){
            //   $_SESSION['post_error_message']=$conn->error.'添加頭像失敗，回到用戶頁面';
            //   require_once ('test_header.php');
            //   exit();
            // }
            $user_icon = file_get_contents($_FILES['user_icon']['tmp_name']);
            $null=null;
            $query='insert into user_icon values(?,?,?)';
            $stmt=$conn->prepare($query);
            if(!$stmt){
                $_SESSION['post_error_message']=$conn->error."update query failed 回到用戶頁面";
                echo "172";
                require_once('test_header.php');
                exit();
            }
            $user_icon_id= $user_id;
            $stmt->bind_param('iib',$null,$user_icon_id,$user_icon);
            $stmt->send_long_data(2,$user_icon);
            if(!$stmt->execute()){
                $_SESSION['post_error_message']=$conn->error.'添加頭像失敗，回到用戶頁面';
                echo $_SESSION['post_error_message']."<br>";
                echo '182';
                require_once ('test_header.php');
                exit();
            }
        }
        header('location:html_userdetail_template.php');
        exit();
    }
?>