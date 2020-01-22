<?php
if(isset($_POST['boolean'])){
$boolean= htmlspecialchars($_POST['boolean']);
echo $boolean;
die('實驗');
}

?>







<form id="myForm" action="" method="post">
        <input type="button" onclick='jsChoose()' id="inputBoolean" value="test"  name="boolean">
</form>


<script>
  function jsChoose(){
    if(confirm("are you sure?")){
    var form_value = document.getElementById("inputBoolean").value;
    console.log(form_value);
    document.getElementById("myForm").submit();
    }
  }

</script>