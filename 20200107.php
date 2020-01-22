<?php
// header("Content-Type: application/json; charset=UTF-8"); 
// $array=[
//   "id"=>1,
//   "username"=>"bombman",
//   "gender"=>"male",
//   "married"=>false
// ];
$string = 'male';
// $json_encode = json_encode($array);
$json_encode = json_encode($string);
setcookie('php_to_js', $json_encode,time()+86400,'/');
// echo $_COOKIE['php_to_js'].'<br>';
// $_COOKIE['php_to_js'] ='take this';

// /**js json send to php */
// header('Content-type: application/json');
header('content-type','application/x-www-form-urlencoded');
// echo filter_input_array(INPUT_POST);
echo file_get_contents('php://input');
$data = json_decode( file_get_contents( 'php://input' ), true );
$str_json = file_get_contents('php://input');
// var_dump($str_json);
// var_dump($data);
// var_dump($HTTP_RAW_POST_DATA);

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json")
{
  $data = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
  global $_POST_JSON;
  $_POST_JSON = json_decode($_REQUEST["JSON_RAW"],true);
  // var_dump($_POST_JSON);
  // merge JSON-Content to $_REQUEST 
  if(is_array($_POST_JSON)) $_REQUEST   = $_POST_JSON+$_REQUEST;
}
// var_dump($_REQUEST);
// echo ' js json<br>';

if($_COOKIE!=null){
  // var_dump($_COOKIE);
  // echo ' cookie<br>';
}
// require_once('js_to_php_with_ajax.php');
// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
//   $ajax = 'ajax has been sent.<br>';
// }else{
//   $ajax = 'no ajax here<br>';
// }
// echo $ajax;


echo <<<_HEREDOC
<html !DOCTYPE
><head><title>20200103</title></head
><body>
<nav>
><a href='20191229.php' id='thislink'>go to 20191229.php</a>
<br><a href='20191230.php' id='thislink2'>go to 20191230.php</a>
<br><a href='20191224.php' id='thislink3'>go to 20191224.php</a>
<br><a href='20191231.php' id='thislink3'>go to 20191231.php</a>
<br><a href='20200107.php' id='thislink3'>go to 20200107.php</a>
</nav>
<section id='a_content' class='current'>
<h6>20200107</h6>
><p id='box' style='color:yellow;'>click me to change color</p
><div id='is'>
<ul>
  <li><strong>list</strong> item 1 - one strong tag</li>
  <li><strong>list</strong> item <strong>2</strong> -
    two <span>strong tags</span></li>
  <li>list item 3</li>
  <li>list item 4</li>
  <li>list item 5</li>
</ul>
</div>
><p id='val'></p>
<select id="single">
  <option>Single</option>
  <option>Single2</option>
</select>
<select id="multiple" multiple="multiple">
  <option selected="selected">Multiple</option>
  <option>Multiple2</option>
  <option selected="selected">Multiple3</option>
</select>
<div id='picture'>
  <img id ='test0' src='upload_compress/stand_man_winter.png'alt='cannot load' height='200' width='80'>
  <img id ='test1' src='upload_compress/seifuku_aifuku_woman2_shirt.png'alt='cannot load' height='200' width='80'>
  <img id ='test2' src='upload_compress/kurofuku_black_man.png'alt='cannot load' height='200' width='80'>
  <select id='toggle_f'>
    <option>togglefade</option>
    <option id='toggle_f0'>0</option>
    <option id='toggle_f1'>1</option>
    <option id='toggle_f2'>2</option>
  </select>
  <select id='toggle_s'>
    <option>toggleslide</option>
    <option id='toggle_s0'>0</option>
    <option id='toggle_s1'>1</option>
    <option id='toggle_s2'>2</option>
  </select><br>
  <button id='show_all_tag'>show all tag</button>
  <button id='slideup'>slideUp</button>
  <button id='slidedown'>slideDown</button>
  </div>
<div id="page"
  ><hl id="header">List</hl
  ><h2>Buy groceries</h2
  ><ul id='append'
    ><li id="one" class="hot"><em>fresh</em> figs</li
    ><li id="two" class="hot">pine nuts</ li
    ><li id="three" class="hot">honey</ li
    ><li id="four">balsamic vinegar</ li
  ></ul 
  ><p id='for_append1' class='event1'>here</p
  ><p id='for_append2' class='event2'>here</p
></div
><div id='find'>
<ul class="level-1">
  <li class="item-i">I</li>
  <li class="item-ii">II
    <ul class="level-2">
      <li class="item-a">A</li>
      <li class="item-b">B
        <ul class="level-3">
          <li class="item-1">1</li>
          <li class="item-2">2</li>
          <li class="item-3">3</li>
        </ul>
      </li>
      <li class="item-c">C</li>
    </ul>
  </li>
  <li class="item-iii">III</li>
</ul>
</div>
><input type="text" id="text1"  placeholder='#text1'><br
><input type="text" id="text2" placeholder='#text1'><br
><button id="button">onclick send json</button><br
><div id="result"></div
><div id='children'>And One Last 
  <p id='layer1'>Time
    <span id='layer2'>m
      <span id='layer3'>one</span>
      y
    </span>
  </p> 
  (most text directly in a div)
</div
><img src='file://C:/xampp/htdocs/laravelFolder/resources/views/learning_php/jquery-ui-1.12.1/images/ui-icons_ffffff_256x240.png'
><section id='content'></section
><section id='JSONP_example'></section
><section id='JS_to_PHP'>
</section>
<script src="jquery-3.4.1.min.js"></script
><script type='text/javascript' src='html_template.js'><!-- //please do not turn off javascript function --></script
><script type='text/javascript' src='20200107.js'><!-- //please do not turn off javascript function --></script
><noscript>sadly your browser is too old to display javascript</noscript
></div>
</section>
></body
></html>

_HEREDOC;
echo ('<br>php true = '.true.'<br>');
echo ('php false = '.false.'<br>');
if($_POST!=null){
  var_dump($_POST);
  echo ' post<br>';
}
if($_GET!=null){
  var_dump($_GET);
  echo ' get<br>';
}
if($_COOKIE!=null){
  var_dump($_COOKIE);
  echo ' cookie<br>';
}
$str_json = file_get_contents('php://input');
var_dump($str_json);
// var_dump($_POST);
echo ' js json<br>';



// <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>

?>