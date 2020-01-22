<?php //test1.php
  $username = 'fred smith';
  echo $username;
  echo '<br>';
  $current_user = $username;
  echo $current_user,"<br>";
  $x=10;
  $y=10;
  if(++$x == 11){
    echo "\$x is $x<br>";
  };
  if($y++ == 10){
    echo "\$y is $y<br>";
  };
  $msgs= 5;
  echo "you have ".$msgs." messages.";
  $author = "Steve Ballmer";
  echo "Developers, developers, developers, developers, 
  developers, developers, developers, developers, developers!

  - $author.<br>";
  $author = "Bill Gates";
  $text = "Measuring programming progress by lines of code is 
  like Measuring aircraft building progress by weight.
  
  - $author.<br>";
  echo $text;
  $author = "Brian W. Kernighan";
  echo <<<_END
  Debugging is twice as hard as writing the code in the first 
  place. Therefore, if you write the code as cleverly as possible, 
  you are, by definition, not smart enough to debug it.
  - $author.<br>
_END;
  $author = "Scott Adams"; $out = <<<_END
  Normal people believe that if it ain't broke, don't fix it. Engineers believe that if it ain't broke, it doesn't have enough features yet.
  - $author.<br> 
_END;
  echo $out;
  echo "what?<br>";
  $number = 838102050;
  echo $number,"<br>";
  echo substr($number, 3, 1),"<br>";
  echo gettype(substr($number, 3, 1)),"<br>";

  $pi = "3.1415927"; 
  $radius = 5; 
  echo $pi * ($radius * $radius),"<br>";
  echo gettype($pi * ($radius * $radius)),"<br>";