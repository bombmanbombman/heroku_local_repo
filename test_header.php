<?php
# anynoumous function 無名自我執行function 
#(function([$para_alias]){code})()
(function(){ 
  global $redirect;
  if(!isset($redirect)){$redirect=null;}
  global $wait_time;
  if(!isset($wait_time)){$wait_time=10;}
  switch($redirect){
    case 'root_directory':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#");
      exit();
      break;
    case 'html_userdetail_template.php':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#/html_userdetail_template.php");
      exit();
      break;
    case 'html_databasemanagement_template.php':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#/html_databasemanagement_template.php");
      exit();
      break;
    case 'html_login_template.php':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#");
      exit();
      break;
    case 'html_searchproduct_template.php':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#/html_searchproduct.php");
      exit();
      break;
    case 'html_userregister_template.php':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#/html_userregister_template.php");
      exit();
      break;
    case 'html_showallproduct_template.php':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#/html_showallproduct_template.php");
      exit();
      break;
    case 'html_marketimage_template.php':
      header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#/html_marketimage_template.php");
      exit();
      break;
    default:
    header("refresh:$wait_time;url=https://bombmanbombman-project1.herokuapp.com/#/html_userdetail_template.php");
  }
})();
exit();
?>