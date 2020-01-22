<?php
$products = array( 
  'paper' => array(
    'copier' => "Copier & Multipurpose", 
    'inkjet' => "Inkjet Printer", 
    'laser' => "Laser Printer", 
    'photo' => "Photographic Paper"
  ),
  'pens' => array(
    'ball' => "Ball Point", 
    'hilite' => "Highlighters", 
    'marker' => "Markers"
  ),
  'misc' => array(
    'tape' => "Sticky Tape", 
    'glue' => "Adhesives",
    'clips' => "Paperclips"     
  ) 
); 
echo "<pre>";
foreach($products as $section => $items) 
  foreach($items as $key => $value) 
  echo "$section:\t$key\t($value)<br>";
echo "</pre>";

printf("<span style='color:#%X%X%X'>Hello</span><br>", 65, 127, 245);
echo "<pre>";
// echo file_get_contents("test1.php");
// echo file_get_contents("https://www.php.net/manual/en/function.each.php");
// echo file_get_contents('http://oreilly.com');
echo "</pre>";
// if(!rename('C:\xampp\htdocs\laravelFolder\resources\views\learning_php\test4.php','C:\xampp\htdocs\laravelFolder\resources\views\learning_php\test1.php')){
//   echo 'rename failed.<br>';
// }else{echo 'rename succeed.<br>';};
print_r($_FILES);
echo "<br>";


