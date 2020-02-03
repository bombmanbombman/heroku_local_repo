$(function(){
    $('#button1').on('click',function(e){
        console.log(e.target);
        window.location.href = 'html_newproduct_template.php';
    });
    $('#button2').on('click',function(e){
        console.log(e.target);
        window.location.href = 'html_displayimage_template.php';
    });
    $('#button3').on('click',function(e){
        console.log(e.target);
        window.location.href = 'html_statistic_template.php';
    });
    $('#button4').on('click',function(e){
        console.log(e.target);
        window.location.href = 'html_photo_viewer.php';
    });

})