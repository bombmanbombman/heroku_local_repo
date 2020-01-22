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
document.write('hello world<br>');
//
string1_='i am a string. ';
string2_='i am a string too. '
document.write(string1_+string2_+'<br>');
// const let var
// console.log(document.getElementById('p2').innerHTML);
// console.log(history.length);
// console.log(history.forward());
// console.log(document.location.href='http://oreilly.com');
//</body>的上一行
// <script type='text/javascript' src=$path></script>
// <noscript>too old to display</noscript>
document.write('review is more important than learning new thing<br>');
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
document.write((a && b) + "<br>") ;   
document.write((b && c) + "<br>") ;   
document.write((a || a) + "<br>") ;   
document.write((a || b) + "<br>") ;   
document.write((b || c) + "<br>") ;   
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
document.write('<pre>');
for(i=0;i<checkerboard.length;i++){
  for(j=0;j<checkerboard[i].length;j++){
  document.write(checkerboard[i][j]+' ');
  }
  document.write('<br>');
}
document.write('</pre>');
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
