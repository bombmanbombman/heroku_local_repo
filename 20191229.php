<?php



echo <<<_HEREDOC
<html
><head
  ><title>1229 DOM+event trigger chapter6</title
></head
><body id='body'
><a href='20191230.php'>go to 20191230.php</a
><form id='formSignup'
    ><select id='package'><option value='monthly'>1 month($5)</option
    ><option>1 year($50)</option
    ></select
    ><div id='packageHint'></div
    ><input type='checkbox' id='terms'>Check to agree to terms & conditions<br
    ><div id='termsHint'></div
    ><label>username</label><br
    ><input type='text' id='username'
    ><div id='noticemessage'></div
    ><textarea id = 'message'></textarea
    ><div id='charactersleft'></div
    ><div id='lastkey'></div
    ><input type='submit' value='NEXT'><br
  ></form
  ><h2>BUY GROCERIES</h2><span id='counter'></span
  ><form
  ><ul id='list'
    ><li>fresh figs</li
  ></ul
  ><div><button><a id='anchor'>ADD LIST ITEM</a></button></div
  ></form>
  ><h2>PROFILE</h2
  ><form id='messageForm'
  ><textarea id='message2'></textarea
  ><input type='submit' value='NEXT'><br
  ></form>
<!-- c06/js/example.js 點擊切換圖片，文字； 輸入文字保留該網頁中。 -->
<div id="page">
  <h1>List King</h1>
  <h2 id="noteName">Audio Note</h2>
  <form action="http://example.org/">
    <label for="noteInput">Enter note name:</label>
    <input type="text" id="noteInput" />
    <div id="buttons">
      <a data-state="record" href="">record</a>
    </div>
  </form>
</div>
<div contentEditable ='true'>可以在html中編輯？</div>

<script type='text/javascript' src='20191229.js' >
<!--//         -->
</script>
<noscript>sadly,your browser is too old to display javascript</noscript>
</body>
</html>





_HEREDOC;


















?>