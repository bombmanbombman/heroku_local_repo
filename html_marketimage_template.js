$(function(){
  $('.delete').on('click',function(e){
    e.preventDefault();
    console.log($('.active').attr('id'));
    if($('.active').attr('id')=='japanese'){
      if(confirm('この写真を削除しますか？')){
        console.log(e.target);
        console.log(e.target.name);
        console.log(e.target.attr('name'));
        let element=e.target;
        // let image_id = ;
        // $.cookie('image_id')
      };
    }
    if($('.active').attr('id')=='chinese'){
      if(confirm('是否确定删除这个图片？')){
        console.log(e.target);
      };
    }
    if($('.active').attr('id')=='english'){
      if(confirm('would you like to delete this image？')){
        console.log(e.target);
      };
    }
  })
})