$(function(){
  $('.delete').on('click',function(e){
    e.preventDefault();
    console.log($('.active').attr('id'));
    console.log(confirm());
  })
})