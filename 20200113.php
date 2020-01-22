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
// header('content-type','application/x-www-form-urlencoded');
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
?>


<html !DOCTYPE>
<head><title>20200113</title></head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding"><style>
/* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
#map {
  height: 100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
</style>
<script id='jquery' src="jquery-3.4.1.js"></script>
<!-- ripple effect library -->
<script src="jquery.ripples.js"></script>
<script id='bootstrap_js' src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script> 
<script id='jquery_ui' src='jquery-ui-1.12.min.js'></script>
<script id='jquery_cookie' src='/jquery-cookie-master/src/jquery.cookie.js'></script>
<script id='vue' src="vue.min.js"></script>
<link id='bootstrap' type='text/css' rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.min.css">
<body>
<section id='google_map'>
  <div id="map"></div>
</section>

<section id='a_content' class='current'>


  <div class='container'>
  <h1 class='display-4 mb-4'>Fetch API Sandbox</h1>
  <div class='d-flex'>
    <button class='btn btn-primary mr-4' id='get_json_text'>fetch.txt</button>
    <button class='btn btn-success mr-4' id='get_json_json'>example_3.json</button>
    <button class='btn btn-warning mr-4' id='get_json_jsonp'>https://jsonplaceholder.typicode.com/</button>
  </div>
    <hr>
    <div id='fetch_api_output'></div>
    <form id='post_json_jsonp'>
      <div class='form-group'>
        <label>http://jsonplaceholder.typicode.com/posts</label><br>
        <input id='post_title' type='text' class='form-control' placeholder='title'><br>
      </div>
      <div class='form-group'>
        <textarea id='post_body' class='form-control' placeholder='body'></textarea><br>
        <input type='submit' class='btn btn-secondary' value='submit'>
      </div>
    </form>
    <form id='js_to_php_to_js' method='post' actioni=''>
      <input id='username' type='text' placeholder='your name'>
      <input id='userage' type='number' placeholder='your age'>
      <input type='submit' value='submit'>
      <div id='result'></div>
    </form>
    <button id='RandomCat'>random cat fetcher</button>
    <button id="randomfox">random dog fetcher</button>
    <button id="fashion">fashion medel fetcher</button>
    <div id='cat_image'></div>
    <form id='OMDb'>
    <input id='user_input_title' type='text' value='terminator'>
    <input type='submit' value='find movie by title'>
    </form>


</section>
<script id='ref' defer async type='text/javascript' src='html_template.js'></script>
<script id='js' defer async type='text/javascript' src='20200113.js'></script>
<!-- google map part -->
<section id='google_map_js'>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAehEZQIPxSSrInvV-wg9MZperouR5Ya5c&region=JP&language=ja&callback=initMap"
  async defer></script>
<script async defer src='google_map.js'></script>
</section>

<noscript>sadly your browser is too old to display javascript</noscript>
</body>
</html>

<?php
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