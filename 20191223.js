onerror=handler;
function handler(message,url,line){
  pop='something is not right \n\n';
  pop += 'error is '+message+'\n';
  pop += 'happened in '+url+'\n';
  pop += 'located in '+line+'\n';
  alert(pop);
}
// console.log('see you in console');
// console.log('<script></script>');
//<head></head><body></body>
// <script src='$path||http://$url||http://$a_path'></script>
// document.write('hello world<br>');
//
string1_='i am a string. ';
string2_='i am a string too. '
// document.write(string1_+string2_+'<br>');
// const let var
// console.log(document.getElementById('p2').innerHTML);
// console.log(history.length);
// console.log(history.forward());
// console.log(document.location.href='http://oreilly.com');
//</body>的上一行
// <script type='text/javascript' src=$path></script>
// <noscript>too old to display</noscript>
// document.write('review is more important than learning new thing<br>');
variable_='js variable';
// php $variable
order_array=['value1',2,'value3',4];
// console.log(order_array[3]);
associative_array={'keyname1':'value1','keyname2':'vlaue2','keyname3':3};
// console.log(associative_array['keyname3']);
// for(i=0;i<order_array.length;i++){
  // console.log(associative_array[i]);
// }
// for(property in associative_array ){
  // console.log(property +' = '+associative_array[property]);
// }
function testscope(){
  global_variable = 'i am in global scope<br>';
  var local_variable = 'i am in local scope<br>';
  for(j=1;j<=2;j++){
    for_array=[1,2,3,4,5,6,7,8];
  }
  return local_variable;
}
testscope();
// console.log(global_variable);
// console.log(testscope());
// console.log(typeof(for_array));
// reference_variable=global_variable;
global_variable='i change my name<br>';
// console.log(global_variable);
reference_variable='i want to change too';
// console.log(global_variable);
// reference_array=for_array;
// console.log(for_array);
// console.log(reference_array);
// reference_array.push(9);
// console.log(reference_array);
// console.log(for_array);
// for_array.push(10);
// console.log(reference_array);
// console.log(for_array);
// reference_asso=associative_array;
// console.log(reference_asso);
// reference_asso.newkeyname='value4';
// associative_array.fullkey='full';
// 
// console.log(reference_asso);
// console.log(associative_array);
// boolean php 無法顯示， true=TRUE false=FALSE TRUE FALSE可以作為const
// js 中 可以顯示  true false 而 TRUE FALSE 是variablename
//
// console.log(document.links.length[0]);
// with(document){
  // console.log(links.length);
  // for(i=0;i<links.length;i++){
    // console.log(links[i].innerHTML);
  // }
// }
// js false =='false' ,0 -0 '' NaN null undefined
// php false == '' array() 0 null emptyobject


a = 0;  
b = 1; 
c = 2; 
// document.write((a && b) + "<br>") ;   
// document.write((b && c) + "<br>") ;   
// document.write((a || a) + "<br>") ;   
// document.write((a || b) + "<br>") ;   
// document.write((b || c) + "<br>") ;   
// document.write('hello word');

checkerboard = Array(
  Array(' ', 'o', ' ', 'o', ' ', 'o', ' ', 'o'), 
  Array('o', ' ', 'o', ' ', 'o', ' ', 'o', ' '), 
  Array(' ', 'o', ' ', 'o', ' ', 'o', ' ', 'o'), 
  Array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '), 
  Array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '), 
  Array('O', ' ', 'O', ' ', 'O', ' ', 'O', ' '), 
  Array(' ', 'O', ' ', 'O', ' ', 'O', ' ', 'O'), 
  Array('O', ' ', 'O', ' ', 'O', ' ', 'O', ' ')
)
// console.log(checkerboard.length);
// document.write('<pre>');
// for(i=0;i<checkerboard.length;i++){
  // for(j=0;j<checkerboard[i].length;j++){
  // document.write(checkerboard[i][j]+' ');
  // }
  // document.write('<br>');
// }
// document.write('</pre>');
// function arrayfind(value,index,array){
//   index++;
//   console.log(index);
//   console.log(array[index-1]);
//   for(j=0;j<array[index-1].length;j++){
//     console.log(array[index-1][j]);
//   }
// }
// console.log(checkerboard.some(arrayfind));
var ages = [4, 12, 16, 20];
// function func_callback(value,loop_index,array) {
  // loop_index++;
  // console.log(loop_index);
  // console.log(array[loop_index-1]);
  // return value ==16 ;
// }
// console.log(ages.some(func_callback));

pets = ["Cat", "Dog", "Rabbit", "Hamster"];
pets.forEach(output);
function output(element, index, array) {
  // console.log(index + ' = ' + element);
  array.push('elephant');
}
// console.log(pets);


var fruits = ["Banana", "Orange", "Apple", "Mango"];
// console.log(fruits.reverse());
// console.log(ages);
// console.log(check_);
var random = ['11','2','5','what','34H'];
// console.log(random.sort((a,b)=>{
//   console.log(a+' '+b);
//   if(a-b<0){
//     console.log('put '+a+' at left '+b+' at right');
//   }else{console.log('put '+b+' at left '+a+' at right');}
//   return a-b}));
// console.log(random.sort());

// console.log(window.location);
// console.log(document.URL);
// console.log(document.lastModified);
var today = new Date();
var hour = today.getHours();
// console.log(today);
var greeting;
if(hour > 18){
  greeting='good evening.<br>';
}else if(hour > 12){
  greeting='good afternoon.<br>';
}else if(hour > 0){
  greeting='good morning.<br>';
}else{
  greeting='bonjour<br>';
}
// console.log(greeting);
var para1=18;
var para2=26;
// console.log(para1,para2);
// function try1(){
  // dozen = para1*para2;
  // return document.getElementById('demo').innerHTML=dozen;
// }
function try1(){
  myname = 'bombman';
  document.getElementById('demo').innerHTML = myname;
  document.getElementById('demo').innerHTML;
}
function try2(){
  var date = new Date();
  hour=date.getHours();
  document.getElementById('demo').innerHTML='it is '+hour+' clock now!';
}
function try3(){
  var wish_list= ['job','girl friend','new house','immigration'];
  document.getElementById('demo2').textContent=wish_list[0];

}

t_array=[1,2,3,4,5,6,7,8,9,0];
t_array.push(11);
t_array.pop();
// console.log(t_array.length);
o_array= new Array(1,2,3,4,5,6,7,8,9,0);
// console.log(o_array[0]);
// console.log(var1='string');
function test(){
  var local_=new Array();
  for(i=0;i<test.arguments.length;i++){
    // console.log(test.arguments[i]);
    local_.push(test.arguments[i]);
  }
    return local_;
}
global_=test(0,1,2,3,4,5,6,7,8,9)
// console.log(global_);
var anonymous = function(){
  return 'anonymous';
}
// console.log(anonymous());
var self_invoke =(function(){document.write ('<br>self invoke<br>')}());
self_invoke;
// console.log(self_invoke);
var classname ={
  key1:'key1 string',
  key2:2,
  key3:function(){
    return this.key1+this.key2;
  }
}
// console.log(classname);
// console.log(classname.key3());
// console.log(classname['key3']);
var classname ={
  key1:'newkey1 string',
  key3:function(){
    return this.key1+this.key2;
  }
}
// console.log(classname);
// console.log(classname.key2);
// console.log(classname.key3())
// console.log(classname['key3']);
// console.log(this.greeting);
// console.log(window.screen);
height=window.innerHeight;
width=window.innerWidth;
device_height=window.screen.height;
device_width=window.screen.width;
history_=window.history.length;
location_=window.location;
function try4(){
  var local_variable='<br>height：'+height+'<br>';
  local_variable +='width：'+width+'<br>';
  local_variable +='device_height：'+device_height+'<br>';
  local_variable +='device_width：'+device_width+'<br>';
  local_variable +='history_：'+history_+'<br>';
  local_variable +='location_：'+location_+'<br>';
  document.getElementById('demo3').innerHTML=local_variable;
}
title=document.title;
url_address=document.URL;
last_modified=document.lastModified;
function try5(){
  var ts='<br>title: '+title+"<br>";
  ts +='url_address: '+url_address+'<br>';
  ts +='last_modified: '+last_modified+'<br>';
  document.getElementById('demo4').innerHTML=ts;
}
function try6(){
  var string_='Home sweet home ';
  var result ='string_.length: '+string_.length+'<br>';
  result +='string_.toUpperCase(): '+string_.toUpperCase()+'<br>';
  result +='string_.toLowerCase(): '+string_.toLowerCase()+'<br>';
  result +='string_.charAt(12): '+string_.charAt(12)+'<br>';
  result +='string_.indexOf(\'ee\'): '+string_.indexOf('ee')+'<br>';
  result +='string_.lastIndexOf(\'e\'): '+string_.lastIndexOf('e')+'<br>';
  result +='string_.substring(8,14): '+string_.substring(8,14)+'<br>';
  result +='string_.split(\' \'): '+string_.split(' ')+'<br>';
  result +='string_.trim(): '+string_.trim()+'<br>';
  result +='string_.replace("me","w"): '+string_.replace("me","w")+'<br>';
  document.getElementById('demo5').innerHTML=result;
}
function try7(){
  var number_=0.0098765;
  var result ='isNaN(number_): '+isNaN(number_)+'<br>';
  result +='number_.toFixed(): '+number_.toFixed(0)+'<br>';
  result +='number_.toPrecision(): '+number_.toPrecision(7)+'<br>';
  result +='number_.toExponential(): '+number_.toExponential()+'<br>';
  result +='Math.round(number_): '+Math.round(number_)+'<br>';
  result +='Math.sqrt(number_): '+Math.sqrt(number_)+'<br>';
  result +='Math.ceil(number_): '+Math.ceil(number_)+'<br>';
  result +='Math.floor(number_): '+Math.floor(number_)+'<br>';
  result +='Math.random(number_): '+Math.random(number_)+'<br>';
  document.getElementById("demo6").innerHTML=result;
}
function try8(){
  var date=new Date();
  var result ='date.getDate(): '+date.getDate()+'<br>';
  result +='date.getDay(): '+date.getDay()+'<br>';
  result +='date.getFullYear(): '+date.getFullYear()+'<br>';
  result +='date.getHours(): '+date.getHours()+'<br>';
  result +='date.getMilliseconds(): '+date.getMilliseconds()+'<br>';
  result +='date.getMinutes(): '+date.getMinutes()+'<br>';
  result +='date.getMonth(): '+date.getMonth()+'<br>';
  result +='date.getSeconds(): '+date.getSeconds()+'<br>';
  result +='date.getTime(): '+date.getTime()+'<br>';
  result +='date.getTimezoneOffset(): '+date.getTimezoneOffset()+'<br>';
  result +='date.toDateString(): '+date.toDateString()+'<br>';
  result +='date.toTimeString(): '+date.toTimeString()+'<br>';
  result +='date.toString(): '+date.toString()+'<br>';
  document.getElementById('demo7').innerHTML=result;
}









