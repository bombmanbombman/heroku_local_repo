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
var_dump($str_json);
var_dump($data);
// var_dump($HTTP_RAW_POST_DATA);

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json")
{
  $data = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
  global $_POST_JSON;
  $_POST_JSON = json_decode($_REQUEST["JSON_RAW"],true);
  var_dump($_POST_JSON);
  // merge JSON-Content to $_REQUEST 
  if(is_array($_POST_JSON)) $_REQUEST   = $_POST_JSON+$_REQUEST;
}
var_dump($_REQUEST);


echo ' js json<br>';

if($_COOKIE!=null){
  var_dump($_COOKIE);
  echo ' cookie<br>';
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
><head><title>20191231</title></head
>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<body>
<nav>
<a href='20191229.php' id='thislink'>go to 20191229.php</a>
<br><a href='20191230.php' id='thislink2'>go to 20191230.php</a>
<br><a href='20191224.php' id='thislink3'>go to 20191224.php</a>
<br><a href='20191231.php' id='thislink3'>go to 20191231.php</a>
<br><a href='20200107.php' id='thislink3'>go to 20200107.php</a>
</nav>
<section id='a_content' class='current'>
<h6>20191231</h6>
<br><input type="text" id="text1"  placeholder='#text1'><br
><input type="text" id="text2" placeholder='#text1'><br
><button id="button">onclick send json</button><br
><section id="result"></div

><section id='content'></section
><section id='JSONP_example'></section
><section id='JS_to_PHP'></section
><script src="//code.jquery.com/jquery-1.12.0.min.js"></script
><script src="example_2.json"></script
><script type='text/javascript' src='html_template.js'><!-- //please do not turn off javascript function --></script
><script type='text/javascript' src='20191231.js'><!-- //please do not turn off javascript function --></script
><script src='http://deciphered.com/js/jsonp.js?callback=showEvents'></script
><noscript>sadly your browser is too old to display javascript</noscript
></section>
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

?>