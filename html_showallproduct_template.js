$(function(){
    $('#button1').on('click',function(e){
        console.log(e.target);
        window.location.href = 'html_newproduct_template.php';
    })
    $('#button2').on('click',function(e){
        console.log(e.target);
        window.location.href = 'html_displayimage_template.php';
    })
})