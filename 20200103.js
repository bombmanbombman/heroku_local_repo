// console.log('hello there');
// onerror=handler;
// function handler(message,url,line){
//   pop='something is not right \n\n';
//   pop += 'error is '+message+'\n';
//   pop += 'happened in '+url+'\n';
//   pop += 'located in '+line+'\n';
//   alert(pop);
// }
// function getTarget(event){
//   if(!event){
//     event = window.event;
//   }
//   return event.target || event.srcElement;
// }
/**document.write(value) */
/**
 * 
 * <script type='text/javascript' src='html_template.js'><!--// --></script>
 * <script type='text/javascript' src=$r_path'><!--// --></script>
 * <noscript>your browser is too old to display javascript</noscript>
 * </body>
 * 
 * 
 */
// document.write('does it work?<br>');
string1 = 'the ground surface still wetting. ';
string2 = 'i have to pay extra attention to ride in case of splid down';
// console.log(string1+string2+'<br>');
//this is a pen
/**this is a apple
 * apple pen
 */
// console.log(thislink.href);
// console.log(document.links.thislink2.href);
// console.log(document.links.length)
// console.log(document.links[0].href);
// console.log(document.links[1].href);
// console.log(document.links[2].href);
// console.log(window.history);
// console.log(window.history.go(0))
// console.log(window.history.back());
// console.log(window.location= 'http://oreilly.com');
order_array =[0,1,2,3,4,5,6,7,8,9];
order_array.push(10);
order_array.pop();
order_array.shift();
order_array.unshift('0');
order_array.splice(0,1,0);
order_array.splice(10,0,10)
// console.log(order_array);
assoc_array={
  prop1:'value1',
  prop2:'value2',
  method1:function(){return this.prop1+' '+this.prop2+'<br>'}
}
assoc_array.prop3='value3';
assoc_array.method2=function(){
  return this.prop1+' '+this.prop2+' '+this.prop3+'<br>';
}
// console.log(assoc_array.method2());
string1 = 'apple dell microsoft hp lenovo acer asus msi';
string1=string1.replace(/ /g,'||');
// console.log(string1);
all_tag=document.getElementsByTagName('*');
// console.log(all_tag);
// console.log(true+' '+false+'<br>');
/**
 * if
 * switch(variable){
 *   case value1:
 *     code block;
 *     break;
 *   ...
 *   default:
 *     code block;
 *     break;
 * }
 * tenary ? : 
 * while 
 * do while
 */
function test(){
  // console.log(arguments);
}
test(0,1,2,3,4,5,6,7,8,9);

var xhr2 = new XMLHttpRequest();                 // Create XMLHttpRequest object

xhr2.onload = function() {                       // When response has loaded
  // The following conditional check will not work locally - only on a server
  // console.log(xhr2.status);
  // console.log(document.getElementById('content'));
  if(xhr2.status === 200) {                       // If server status was ok
    document.getElementById('content').innerHTML = xhr2.responseText; // Update
  }
};

xhr2.open('GET', 'ajax.html', true);        // Prepare the request
xhr2.send(null);                                 // Send the request

// NOTE: If you run this file locally
// You will not get a server status
// You can set the conditional statement to true on line 5 as shown below
// if(true) {

//c08/js/data-jsonp.js   
//JSONP
function showEvents(data){
  let newContent = '';
  for(var i=0;i<data.events.length;i++){
    newContent += '<div class="event">';
    newContent += '<img src="' + data.events[i].map + '"';
    newContent += ' alt="' + data.events[i].location +'"/>';
    newContent += '<p><b>' + data.events[i].location +'</b><br>';
    newContent += data.events[i].date +'</p>';
    newContent += '</div>';
  }
  document.getElementById('JSONP_example').innerHTML = newContent;
}

/**pass php variable to js via ajax */
const xhr = new XMLHttpRequest();
// xhr.open('POST', 'js_to_php_with_ajax.php', true);
xhr.open('POST', 'js_request_php_json.php', true);
xhr.responseType = 'json';
xhr.onload = function(event) {
  if (xhr.status == 200 && xhr.readyState ==4) {
    // console.log('response succeed');
    // console.log(typeof(this.response));
    JSON_String =JSON.stringify(this.response);
    JSON_object =JSON.parse(JSON_String);
    if(typeof(this.response == 'object')){
      json_object=this.response;
      // console.log(json_object);
    }else if(typeof(this.response == 'string')){
      // console.log(typeof(this.response));
      // console.log(xhr.response);
      json_object=JSON.parse(this.response);
      // console.log(json_object);
    }
    php_variable = '';
    document.getElementById('JS_to_PHP').innerHTML = json_object.php_key1+' '+json_object.php_key2;
  }
};
/**setRequestHeader 要在 open() 之後  send() 之前 */
// xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
variable1 = 1;
variable2 = 20;
xhr.send();
// pass js variable to php via ajax
/** send js cookie to php  已經成功 */
document.cookie = 'js_variable1=;max-age=0';
document.cookie = 'js_variable2=;max-age=0';
// document.cookie = 'js_variable1='+variable1;
// document.cookie = 'js_variable2='+variable2;
// console.log(document.cookie);
js_variable = document.cookie;
// console.log(typeof(js_variable));
/**get php cookie */  //http://www.satya-weblog.com/2007/05/php-and-javascript-cookie.html
// console.log(document.cookie);
// console.log(typeof(document.cookie));
unescaped = unescape(document.cookie);
index = unescaped.indexOf('=');
var php_to_js_cookie = unescaped.substr(index+1);
var php_to_js_cookie =php_to_js_cookie.replace(/"||'/g,'')
// console.log(php_to_js_cookie);

/**js to php via  ajax JSON */
json_made = {
  "mysql": [
    {
      "id": 1,
      "name": "bombman",
      "gender": [0,1,2],
      "marriage": false
    },
    {
      "id": 2,
      "name": "rockman",
      "gender": [1,2,3],
      "marriage": true
    },
    {
      "id": 3,
      "name": "megaman",
      "gender": [2,3,4],
      "marriage": false
    }
  ]
}
const request= new XMLHttpRequest();
// request.open("POST", "20191231.php", true)
request.open("GET", "20191231.php?x="+JSON.stringify(json_made), true)
// request.setRequestHeader('content-type','application/x-www-form-urlencoded');
request.setRequestHeader("Content-type", "application/json")
// console.log(json_made);
json_made = JSON.stringify(json_made);
// console.log(json_made);
request.send(json_made);
request.onreadystatechange = function () {
  if (request.readyState === 4 && request.status === 200) {
      // in case we reply back from server
      // console.log(this.responseText)
      // jsondata = JSON.parse(request.responseText);
      // console.log(jsondata);
  }
}

//Jquery send json to php
$('#button').click(function() {
  var val1 = $('#text1').val();
  var val2 = $('#text2').val();
  $.ajax({
      type: 'POST',
      url: '20191231.php',
      data: { text1: val1, text2: val2 },
      success: function(response) {
          $('#result').html(response);
      }
  });
});
// $.getJSON('example_2.json',function(JSON__object){
//   $.each(JSON__object,function(index,value){
//     console.log(value);
//   })
// })
console.log(all_tag);
$(':header').addClass('headline');
$('li:lt(3)').hide().delay(500).fadeIn(1500);
$('li').on('click', function () {
  $(this).remove();
});

all_anchor=$('a');
console.log(all_anchor);
console.log($('a:first').html());
$('*:focus').css('color','blue')

$('#box').on('click',function(){
  $(this).css('color','red');
})
$('#box').on('mouseleave',function(){
  $(this).css('color','yellow');
})

function displayVals() {
  var singleValues = $( "#single" ).val();
  var multipleValues = $( "#multiple" ).val();
  // When using jQuery 3:
  // var multipleValues = $( "#multiple" ).val();
  $( "#val" ).html( "<b>Single:</b> " + singleValues +
    " <b>Multiple:</b> " + multipleValues.join( ", " ) );
}
$( "select" ).change( function(){displayVals()} );
$( "li.item-ii" ).find( "li" ).css( "background-color", "red" );
$('#children').children('#layer1').css('color','pink');
$('#children').find('#layer3').css('color','green');

// $('#for_append').append($('#append'));
$(function() {
  var $listHTML = $('#append').html();
  console.log($listHTML);
  $('#append').append($listHTML);
});

$(function(){
  var variable = $('li').css('background-color');
  $('ul#append').append( '<p>Color was: '+variable+'</p>' );
  $('ul#append li').css({
    'background-color':'#c5a996',
    'border':'1px solid #fff',
    'color':'#000',
    'font-family':'Georgia',
    'padding-left':'+=75',
  })
})

$('*').on('mouseenter',function(e){
  var date = new Date;
  date.getTime(e.timeStamp);
  var time = date.toLocaleString();
  $('*').children('strike').remove();
  $(this).append('<strike>'+' '+this.getAttribute('class')+' '+time+'</strike>');
});







