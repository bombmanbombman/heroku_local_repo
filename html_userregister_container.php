<div class="d-flex justify-content-center">
  <form action="$_SERVER[PHP_SELF]" method="post">
    <label id='echo4'>請僅僅輸入數字與英語字母，各種符號會被過濾</label><br>
    <div class='align' style='width:190px'>
      <label id='echo5'>新用戶名</label>
      <input type="text" name="user_name"><br>
    </div>
    <div class='align' style='width:190px'>
      <label id='echo6'>註冊密碼</label>
      <input type="password" maxlength='12' name="user_password"><br>
      <input class='btn btn-dark' id='value1'type="submit" value="提交"><br>
    </div>
  </form>
</div>