$(function(){
  $('.delete').on('click',function(e){
    e.preventDefault();
    console.log($('.active').attr('id'));
    if($('.active').attr('id')=='japanese'){
      if(confirm('この写真を削除しますか？')){
        console.log(e.target);
        let image_id =e.target.name;
        let product_id = $('#product_id').html();
        console.log('image_id:'+image_id);
        console.log('product_id:'+product_id);
        $.ajax({
          type:"POST",
          url:"html_deleteimage_template.php",
          data:{
            image_id:image_id,
            product_id:product_id
          },
          dataType:""
        }).done(function(data){
          console.log('結果是:'+data);
          if(data !='error0'||data !='error1'){
            $('#error_message').css({
              "color":"#ff4000"
            });
            if($('a#chinese').hasClass('active')){
              $('#error_message').text('成功删除图片').show(0).hide(8000);
              }else if($('a#japanese').hasClass('active')){
                $('#error_message').text('写真を削除しました').show(0).hide(8000);
              }else if($('a#english').hasClass('active')){
                $('#error_message').text('this image has been deleted').show(0).hide(8000);
              }
            
          }else if(data == 'error0'){
            $('#error_message').css({
              "color":"red"
            });
            if($('a#chinese').hasClass('active')){
            $('#error_message').text('网络不稳定').show(0).hide(8000);
            }else if($('a#japanese').hasClass('active')){
            $('#error_message').text('ネットの接続が不安定').show(0).hide(8000);
            }else if($('a#english').hasClass('active')){
              $('#error_message').text('unstable connection').show(0).hide(8000);
            }
          }else if(data == 'error1'){
            $('#error_message').css({
              "color":"red"
            });
            if($('a#chinese').hasClass('active')){
            $('#error_message').text('database有问题').show(0).hide(8000);
            }else if($('a#japanese').hasClass('active')){
            $('#error_message').text('データベースに問題あり').show(0).hide(8000);
            }else if($('a#english').hasClass('active')){
              $('#error_message').text('sth wrong with database').show(0).hide(8000);
            }
          }
        }).fail(function(error){
          console.log(error);
        });
      };
    }
    if($('.active').attr('id')=='chinese'){
      if(confirm('是否确定删除这个图片？')){
        let image_id =e.target.name;
        let product_id = $('#product_id').html();
        $.ajax({
          type:"POST",
          url:"html_deleteimage_template.php",
          data:{
            image_id:image_id,
            product_id:product_id
          },
          dataType:""
        }).done(function(data){
          console.log('結果是:'+data);
          if(data !='error0'||data !='error1'){
            let array=data.split('||');
            // $.cookie('user_id',array[0]);
            // console.log(array);
            $('#error_message').css({
              "color":"#ff4000"
            });
            if($('a#chinese').hasClass('active')){
              $('#error_message').text('成功删除图片').show(0).hide(8000);
              }else if($('a#japanese').hasClass('active')){
                $('#error_message').text('写真を削除しました').show(0).hide(8000);
              }else if($('a#english').hasClass('active')){
                $('#error_message').text('this image has been deleted').show(0).hide(8000);
              }
          }else if(data == 'error0'){
            $('#error_message').css({
              "color":"red"
            });
            if($('a#chinese').hasClass('active')){
            $('#error_message').text('网络不稳定').show(0).hide(8 000);
            }else if($('a#japanese').hasClass('active')){
            $('#error_message').text('ネットの接続が不安定').show(0).hide(8000);
            }else if($('a#english').hasClass('active')){
              $('#error_message').text('unstable connection').show(0).hide(8000);
            }
          }else if(data == 'error1'){
            $('#error_message').css({
              "color":"red"
            });
            if($('a#chinese').hasClass('active')){
            $('#error_message').text('database有问题').show(0).hide(8000);
            }else if($('a#japanese').hasClass('active')){
            $('#error_message').text('データベースに問題あり').show(0).hide(8000);
            }else if($('a#english').hasClass('active')){
              $('#error_message').text('sth wrong with database').show(0).hide(8000);
            }
          }
        }).fail(function(error){
          console.log(error);
        });
        console.log(e.target);
      };
    }
    if($('.active').attr('id')=='english'){
      if(confirm('would you like to delete this image？')){
        let image_id =e.target.name;
        let product_id = $('#product_id').html();
        $.ajax({
          type:"POST",
          url:"html_deleteimage_template.php",
          data:{
            image_id:image_id,
            product_id:product_id
          },
          dataType:""
        }).done(function(data){
          console.log('結果是:'+data);
          if(data !='error0'||data !='error1'){
            let array=data.split('||');
            // $.cookie('user_id',array[0]);
            // console.log(array);
            $('#error_message').css({
              "color":"#ff4000"
            });
            if($('a#chinese').hasClass('active')){
              $('#error_message').text('成功删除图片').show(0).hide(8000);
              }else if($('a#japanese').hasClass('active')){
                $('#error_message').text('写真を削除しました').show(0).hide(8000);
              }else if($('a#english').hasClass('active')){
                $('#error_message').text('this image has been deleted').show(0).hide(8000);
              }
          }else if(data == 'error0'){
            $('#error_message').css({
              "color":"red"
            });
            if($('a#chinese').hasClass('active')){
            $('#error_message').text('网络不稳定').show(0).hide(8000);
            }else if($('a#japanese').hasClass('active')){
            $('#error_message').text('ネットの接続が不安定').show(0).hide(8000);
            }else if($('a#english').hasClass('active')){
              $('#error_message').text('unstable connection').show(0).hide(8000);
            }
          }else if(data == 'error1'){
            $('#error_message').css({
              "color":"red"
            });
            if($('a#chinese').hasClass('active')){
            $('#error_message').text('database有问题').show(0).hide(8000);
            }else if($('a#japanese').hasClass('active')){
            $('#error_message').text('データベースに問題あり').show(0).hide(8000);
            }else if($('a#english').hasClass('active')){
              $('#error_message').text('sth wrong with database').show(0).hide(8000);
            }
          }
        }).fail(function(error){
          console.log(error);
        });
        console.log(e.target);
      };
    }
  })
})