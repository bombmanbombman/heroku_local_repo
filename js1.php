<?php
echo "today i have been wetted all my up body.<br>";
require_once ("html_navibar_template.php");

echo <<< _HEREDOC
<html>
  <head><title>javascript say hello</title></head>
  <body>
  <section id='a_content' class='current'>
    <br><br><br>
    <a id='url0' href='url0'>link1</a>
    <a id='url1' href='url1'>link2</a>
    <br>
    <script type="text/javascript">
    <!--//
      document.write(typeof(string1_) + '<br>');
      document.write("Hello World\251 "+'<br>');
      document.write(' it is a inline tag'+'<br>');
      document.write('you '+'are '+'stupid.<br>');
      document.write('\233 '+'\xFF '+'\uFFFF <br>');
      datatype1_='838102050';
      document.write(typeof(datatype1_) + '<br>');
      datatype2_=12345*67980;
      document.write(typeof(datatype2_) + '<br>');
      datatype3_=datatype2_;
      datatype3_+=datatype1_;
      document.write(typeof(datatype3_) + '<br>');
      var string1_='today';
      string2_=string1_;
      string3_='yesterday';
      string4_='\251';
      document.write(typeof(string1_) + '<br>');
      var url0_=document.links[0];
      // document.write(url0_ + ' <br>');
      for(i=0;i<document.links.length;i++){
        document.write(document.links[i].href + '<br>');
      }
      for(i=0;i<document.links.length;i++){
        document.write(document.links[i] + '<br>');
      }
      document.write(dump(datatype3_)+'<br>');
      for(i=0;i<history.length;i++){
        document.write(history[i] + '<br>');
      }
      // history.back();  //被comment化
      document.write(string2_ + '<br>');
      // document.location.href = 'http://www.google.co.jp';
      boolean_=8>2;
      document.write(typeof(boolean_)  + '<br>');
      what = document.write(boolean_);
      document.write('<br>' + typeof(what)  + '<br>');
      if(1==true){
        document.write(typeof(true) + '<br>');
      }
      console.log(true);
      console.log(false);
      console.log(document.links.url0.href);
      // console.log('it is working.');

    -->
    </script>
    <noscript>
      sadly.your browser does not support javascript.
    </noscript>
    <h1>what a day?</h1>
    </section>
  </body>
</html>






_HEREDOC;







// echo 'who is there ? <br>';
?>
<h1>tag in php not work?</h1>
<h2>are they</h2>