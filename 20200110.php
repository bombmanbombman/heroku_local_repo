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
<html !DOCTYPE>
<head><title>20200110</title></head>
<body>
<section id='a_content' class='current'>
<div id='test_ajax'>
<br><button id='ajax1'>send ajax request</button>
  <div id='response'></div>
</div>
<!--geolocation api-->
<div id='geolocation_'>
  <button>show my coordination</button>
  <div class="third" id="loc">We are trying to find your location.</div>
</div>
<!--web storage localStorage object-->
<div class="two-thirds">
<form id="application" action="">
  <label for="username">Name</label>
  <input type="text" id="username" name="username" /><br>
  <label for="answer">Answer</label>
  <textarea id="answer" name="answer"></textarea><br>
  <label for="username2">Name2</label>
  <input type="text" id="username2" name="username2" /><br>
  <label for="answer2">Answer2</label>
  <textarea id="answer2" name="answer2"></textarea>
  <br>
  <input type="submit" value="Save" />
</form>
<button id ='test_click'>click to show webStorage log</button>
</div>
<h1>end of body part</h1>
</section>
<section id='load_js' class='current'>
<!--modernizr 用於 geolocation-->

<script src="jquery-3.4.1.min.js"></script>
<script type='text/javascript' src="modernizr.2.7.1.js"></script>
<script id='ref' type='text/javascript' src='html_template.js'><!-- //please do not turn off javascript function --></script>
<script id='js' type='text/javascript' src='20200110.js'><!-- //please do not turn off javascript function --></script>
<noscript>sadly your browser is too old to display javascript</noscript>
</sec>
</body>
</html>
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