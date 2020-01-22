// 導入 error handler 3line
let script = document.createElement('script');
script.src='html_onerror_errorhandler.js';
document.body.append(script);

//導入 方法2 1line
// import * as module from './html_onerror_errorhandler.js';

document.write('<br>'+'how are you?<br>');
// console.log('does console.log work?');
// console.log(confirm('are you sure about that?'));
//this is a js comment.
/**
 * multiple lines comment.
 * js concatenation is + 
 * 
 */
function testlocal(){
  var localvariable_='i am local in here.';
  globalvariable_='i am a global variable,despite that i am in function.<br>'
  return document.write('<br>'+localvariable_+' '+typeof(localvariable_) +'<br>');
}
document.write('extension started? or not?oryes?');
testlocal();
// console.log(document.links.url0.href);
// console.log(document.links[1]);
// console.log(globalvariable_);
// console.log(thislink.href);
// console.log(document.links.length);
// console.log(url0.href);
// console.log(document.getElementById('thislink').href);
// console.log(history.length);
// console.log(history.go(0));
// document.write('this is auto reload');
// console.log(history.back());
// console.log(document.location.href='http://localhost:8012/laravelFolder/resources/views/learning_php/js1.php');
a = '11'; 
b = 11; 
if (a > b) document.write("a is greater than b<br>"); 
if (a < b) document.write("a is less than b<br>");
if (a >= b) document.write("a is greater than or equal to b<br>"); 
if (a <= b) document.write("a is less than or equal to b<br>");

a = 0; 
b = 1;
c = 2;
document.write((a && b) + "<br>") ;
document.write((b && c) + "<br>") ;
document.write((a || a) + "<br>") ;
document.write((a || b) + "<br>") ;
document.write((a || c) + "<br>") ;
document.write(( !a ) + "<br>");
// 1220
onerror = errorHandler;
function errorHandler(message,url,line){
  out = 'Sorry,an error was encountered.<br>';
  out +='Error: '+message+'<br>';
  out +='URL: ' +url+'<br>';
  out +='Line: '+line+'<br>';
  out +='Click OK to continue.<br>';
  alert(out);
  return true;
}
// console.log(typeof(1));
// console.log(typeof(1.1));
Number.prototype.absolute_value=function(){
  if(this<0){
    return -this;
  }
}
negative = -1;
document.write(negative.absolute_value());  