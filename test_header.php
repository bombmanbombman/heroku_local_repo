<?php
# anynoumous function 無名自我執行function 
#(function([$para_alias]){code})()
(function(){ 
  global $redirect;
  // echo $redirect;
  if(!isset($redirect)){$redirect=null;}
  global $wait_time;
  if(!isset($wait_time)){$wait_time=4;}
  // if(strpos($domain,'herokuapp.com')){
  $URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    //檢查 URL中是否有herokuapp.com
  // echo $URL;
  // echo strpos($URL,'localhost:3000');
  if(strpos($URL,'herokuapp.com')){
    //heroku用
    switch($redirect){
      case 'root_directory':
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com");
        exit();
        break;
      case 'html_userdetail_template.php':
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/html_userdetail_template.php");
        exit();
        break;
      case 'html_databasemanagement_template.php':
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/html_databasemanagement_template.php");
        exit();
        break;
      case 'html_login_template.php':
        echo 'back to login page';
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com");
        exit();
        break;
      case 'html_searchproduct_template.php':
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/html_searchproduct.php");
        exit();
        break;
      case 'html_userregister_template.php':
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/html_userregister_template.php");
        exit();
        break;
      case 'html_showallproduct_template.php':
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/html_showallproduct_template.php");
        exit();
        break;
      case 'html_marketimage_template.php':
        header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/html_marketimage_template.php");
        exit();
        break;
      default:
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com");
    }
  }else if(strpos($URL,'host:8012')){
    //xampp 用
    switch($redirect){
      case 'root_directory':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/");
        exit();
        break;
      case 'html_userdetail_template.php':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_userdetail_template.php");
        exit();
        break;
      case 'html_databasemanagement_template.php':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_databasemanagement_template.php");
        exit();
        break;
      case 'html_login_template.php':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_login_template.php");
        exit();
        break;
      case 'html_searchproduct_template.php':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_searchproduct.php");
        exit();
        break;
      case 'html_userregister_template.php':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_userregister_template.php");
        exit();
        break;
      case 'html_showallproduct_template.php':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_showallproduct_template.php");
        exit();
        break;
      case 'html_marketimage_template.php':
        header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_marketimage_template.php");
        exit();
        break;
      default:
      header("refresh:$wait_time;url=http://localhost:8012/laravelFolder/resources/views/learning_php/html_login_template.php");
    }
  }
  else if(strpos($URL,'host:3000')){
    //localhost:3000 用
    switch($redirect){
      case 'root_directory':
        header("refresh:$wait_time;url=http://localhost:3000/");
        exit();
        break;
      case 'html_userdetail_template.php':
        header("refresh:$wait_time;url=http://localhost:3000/html_userdetail_template.php");
        exit();
        break;
      case 'html_databasemanagement_template.php':
        header("refresh:$wait_time;url=http://localhost:3000/html_databasemanagement_template.php");
        exit();
        break;
      case 'html_login_template.php':
        header("refresh:$wait_time;url=http://localhost:3000/index.php");
        exit();
        break;
      case 'html_searchproduct_template.php':
        header("refresh:$wait_time;url=http://localhost:3000/html_searchproduct.php");
        exit();
        break;
      case 'html_userregister_template.php':
        header("refresh:$wait_time;url=http://localhost:3000/html_userregister_template.php");
        exit();
        break;
      case 'html_showallproduct_template.php':
        header("refresh:$wait_time;url=http://localhost:3000/html_showallproduct_template.php");
        exit();
        break;
      case 'html_marketimage_template.php':
        header("refresh:$wait_time;url=http://localhost:3000/html_marketimage_template.php");
        exit();
        break;
      default:
      header("refresh:$wait_time;url=http://localhost:3000/index.php");
    }
  }
})();
exit();
?>