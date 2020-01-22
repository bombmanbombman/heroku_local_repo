<?php
require_once ('jumpback.php');
if(isset($_POST['name'])){
  $name=$_POST['name'];
  var_dump($_POST);
}else $name = '(Not entered)';
$html = <<<_HEREDOC
<html !DOCTYPE>
<head><title>form handling</title></head>
<body>
your name is:$name<br>
<form method='post' action=''>
<pre>
what is your name?<input type='text' name='name'>
       Loan Amount<input type='text' name='principle'>
Monthyly Repayment<input type='text' name='monthly'>
   Number of Years<input type='text' name='years' value='25'>
          Interest<input type='text' name='rate' value='6'>
    do you agreed <input type='checkbox' name='checkbox'>
                  <input type='submit' value='transfer'>
</pre>
</form>
</body>
</html>



_HEREDOC;
echo $html;

























?>