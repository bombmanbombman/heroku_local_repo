<?php
if(!isset($_POST)){
  /**php */
  // echo "網絡接觸不穩定";
  // header('location:html_marketimage_template.php');
  /**phpjs */
  echo 'error0';
}
if(isset($_POST)&&isset($_POST['image_id'])&&isset($_POST['product_id'])){
  session_start();
  require_once('login.php');
  /**php*/
  // var_dump($_POST);
  // echo "<br>";
  // $check_image_id=array_keys($_POST);
  // $check_image_id=$check_image_id[0];
  // $user_id = $_SESSION['user_id'];
  // $query = 'delete from image 
  //             where image_id = '.$check_image_id.' and   user_id ='.$user_id;
  // $stmt=$conn->query($query);
  // if(!$stmt)echo($conn->error);
  // echo "已經成功刪除了指定的圖片";
  // $redirect='html_marketimage_template.php';
  // require_once('test_header.php');
  
  /**phpjs*/
  
  $user_id = $_SESSION['user_id'];
  $query = 'delete from image 
              where image_id = '.$_POST['image_id'].' and   user_id ='.$user_id;
  $stmt=$conn->query($query);
  if(!$stmt){
    echo($conn->error.'||error1');
  };
  echo "已經成功刪除了指定的圖片";
}



























?>