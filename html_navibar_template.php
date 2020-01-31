
<style>
ul {
  list-style-type: none; /*#去除<ul>bullet前的點*/
  margin: 0;
  padding: 0;
}
li  { 
  float:left;  /*同樣的tag 都擠在一行中,而且擠在左邊*/
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}
a.navi{
  display:block;  
  padding: 8px;
  background-color: #dddddd;
}
li a:hover {   /* hover時的style */
  background-color: #555;
  color: white;
}
.active {      /*針對 class='active'的tag */
  background-color: #4CAF50;
  color: white;
}
</style>


<div class="dropdown"> 
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" 
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> language toggle </button> 
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
      <a id='japanese' class="dropdown-item active actived-language" href="#">日本語</a> 
      <a id='chinese' class="dropdown-item" href="#">繁體中文</a> 
      <a id='english' class="dropdown-item" href="#">english</a> 
    </div> 
</div> 
<ul>
<?php 
$URL =$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
if(strpos($URL,'herokuapp.com')){
  echo "<li><a class='btn btn-info' href='https://bombmanbombman-project1.herokuapp.com/html_userdetail_template.php'>user detail page</a></li>";
  echo "<li><a class='btn btn-info' href='https://bombmanbombman-project1.herokuapp.com/'>sign out</a></li>";
}else{
  echo "<li><a class='btn btn-info' href='html_userdetail_template.php'>user detail page</a></li>";
  echo "<li><a class='btn btn-info' href='index.php'>sign out</a></li>";
}
?>
  <!-- <li><a class='navi' href="">sign out</a></li> -->
  <li><a class='btn btn-info' href='20200113.php'>map</a></li>
  <li id='time_table'></li>
  <!--float:right 取消display block，成為一條線 且擠在右邊-->
  <?php
    if($_SESSION['user_id']===1){
      echo "
        <li id='admin' style='float:right'>
      ";
    }else{
      echo "
      <li id='admin' style='display:none'>
      ";
    }
  ?>
    <select name='forma' onchange="location = this.value">
      <option value="select">select page</option>
      <option value ="backup_sql_exec.php">備份database</option>
      <option value ="https://bombmanbombman-project1.herokuapp.com/">LOGIN</option>
      <option value ="html_login_desktop.php">LOGIN desktop</option>
      <option value="html_userdetail_template.php">用戶頁面</option>
      <option value="html_adduserdetail_template.php">修復用戶添加資料頁面bug</option>
      <option value="html_statistic_template.php">statistics table</option>
      <option class="active" value="html_newproduct_template.php">添加新貨品</option>
      <option class="active" value="html_showallproduct_template.php">顯示用戶所有貨號</option>
      <option value='html_adduserdetail_template.php'>改變user信息</option>
      <option value="https://bombmanbombman-project1.herokuapp.com/">root directory</option>
    </select>
  </li>
</ul>
<br>
<br>