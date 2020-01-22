$('#picture').on('click',function(e){
  // console.log($('#picture').children());
  c_length = $('#picture').children().length;
  // console.log(c_length);
  // console.log(e.target);
  // console.log(e.target.id);
  for(let i=0;i<c_length;i++){
    // console.log(i);
    if(e.target.id==('test'+i) ){
      $('#test'+i).fadeToggle(2000,function(){
        // $('#test'+i).show();
        // console.log('i='+i);
      });
    }
  }
  $('* strike').remove();
  $(this).append('<strike>'+e.target+'</strike>')
})
$('#toggle_f').on('change',function(e){
  // console.log($('#toggle_f').children());
  let select_val=$('#toggle_f').val();
  // console.log(select_val);
  let match_id='test'+select_val;
  // console.log(match_id);
  if($('#'+match_id) != undefined){
    console.log($('#'+match_id));
    $('#'+match_id).fadeToggle(2000);
  }
})

$('#toggle_s').on('change',function(e){
  // console.log($('#toggle_s').children());
  let select_val=$('#toggle_s').val();
  // console.log(select_val);
  let match_id='test'+select_val;
  // console.log(match_id);
  if($('#'+match_id) != undefined){
    console.log($('#'+match_id));
    $('#'+match_id).slideToggle(2000);
  }
})

$('#slidedown').on('click',function(e){
  $('div img').slideDown('1000');
})
$('#slideup').on('click',function(e){
  $('div img').slideUp('1000');
})

$('#show_all_tag').on('click',function(e){
  console.log($('#picture'));
})

// console.log($('*'));
// $('*').each(function(index,element){
  // console.log(index);
  // console.log(element);
  // console.log(element.tagName);
  // console.log($(element).prop('tagName'));
  // console.log($(this).prop('tagName').toLowerCase());
// });

result = $('*').map(function(index,element){
  // console.log(index);
  // console.log(element);
  // console.log(element.tagName);
  // console.log($(element).prop('tagName'));
  // console.log($(this).prop('tagName').toLowerCase());
  return element.tagName;
});
console.log(result);

$( "div#is ul li" ).click(function() {
  var li = $( this ),
    isWithTwo = li.is(function() {
      console.log($('strong'));
      console.log($('strong',this));
      console.log($(this).find('strong'));
      return $( "strong", this ).length === 2;
      // return $( "strong", this ).length === 2;
    });
  if ( isWithTwo ) {
    li.css( "background-color", "green" );
  } else {
    li.css( "background-color", "red" );
  }
});