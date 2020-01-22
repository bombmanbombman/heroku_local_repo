<?php



echo <<<_HEREDOC
<html
><head
  ><title>1224 DOM chapter5</title
></head
><body id='body'>
<nav>
<a href='20191229.php' id='thislink'>go to 20191229.php</a>
<br><a href='20191230.php' id='thislink2'>go to 20191230.php</a>
<br><a href='20191224.php' id='thislink3'>go to 20191224.php</a>
<br><a href='20191231.php' id='thislink3'>go to 20191231.php</a>
<br><a href='20200107.php' id='thislink3'>go to 20200107.php</a>
</nav>
<section id='a_content' class='current'>
  <h6>20191224</h6>
  <a id='a1' href='http://www.google.co.jp'>to google jp</a
  ><a id='a2' href='http://www.google.com'>to google us</a
  ><a id='a3' href='http://www.google.co.uk'>to google uk</a
  ><a id='a4' href='http://www.google.cn'>to google cn</a
  ><a id='a5' href='http://www.google.it'>to google italy</a
  ><a id='a6' href='http://www.google.au'>to google austrilia</a
  ><div id='page'
  ><h1 id='header'>List</h1
  ><h2>Buy groceries</h2
  ><ul
    ><li id='one' class='hot'>six <em style='visibility:hidden;'>fresh</em> figs</li
    ><li id='two' class='hot'>pine nuts</li
    ><li id='three' class='hot'>honey</li
    ><li id='four'>balsamic vinegar</li
  ></ul>
  </div>
  <form><label>username</label><br
    ><input type='text' id='username'
    ><div id='noticemessage'></div
    ><textarea id = 'message'></textarea
    ><div id='charactersleft'></div
    ><div id='lastkey'></div
  ></form
  ><ul id='shoppingList'
    ><li class = 'complete'><a href='itemDone.php?id=1'><em>fresh</em> figs</a></li
    ><li class = 'complete'><a href='itemDone.php?id=2'>pine nuts</a></li
    ><li class = 'complete'><a href='itemDone.php?id=3'>honey</a></li
    ><li class = 'complete'><a href='itemDone.php?id=4'>balsamic vinegar</a></li
  ></ul
  ><table id='position'>
    <tr>
      <th>sx </th>
      <th>sy </th>
      <th>px </th>
      <th>py </th>
      <th>cx </th>
      <th>cy </th>
    </tr>
    <tr>
      <td id='sx'></td>
      <td id='sy'></td>
      <td id='px'></td>
      <td id='py'></td>
      <td id='cx'></td>
      <td id='cy'></td>
    </tr>
  </table>


<script type='text/javascript' src='20191224.js' >
<!--//         -->
</script>
<noscript>sadly,your browser is too old to display javascript</noscript>
</section>
</body>
</html>





_HEREDOC;


















?>