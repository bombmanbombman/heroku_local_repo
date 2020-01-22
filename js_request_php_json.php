<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
  $ajax = 'ajax request received.';
  $php_json = [
    "ajax"=>$ajax,
    "php_key1"=>"i am in php",
    "php_key2"=>"i am in php as well"
  ];
  echo json_encode($php_json);
} else {
  echo json_encode(['ajax'=>'your forgot xmlhttp.setRequestHeader("X-Requested-With","XMLHttpRequest"); ']);
}

// $php_json = [
//   'ajax'=>$ajax,
//   'php_key1'=>'i am in php',
//   'php_key2'=>'i am in php as well'
// ];
// echo json_encode($php_json);


?>
