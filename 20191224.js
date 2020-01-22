onerror=handler;
function handler(message,url,line){
  pop='something is not right \n\n';
  pop += 'error is '+message+'\n';
  pop += 'happened in '+url+'\n';
  pop += 'located in '+line+'\n';
  alert(pop);
}
function getTarget(event){
  if(!event){
    event = window.event;
  }
  return event.target || event.srcElement;
}
hot=document.getElementsByClassName('hot');
tag=document.getElementsByTagName('a');
innerhtml=document.getElementsByTagName('body').innerhtml;
one=document.getElementById('one');
var orderarray=[1,2,3,4,5,6,7,8,9,10];
function classname(){
  this.property1 ='property1';
  this.property2 ='property2';
  this.methodname1=function(){
    return this.property1+this.property2;
  }
}
objectname = new classname;
// console.log(objectname.methodname1);
var ul = document.getElementsByTagName('ul')[0];
var one =ul.firstChild;
var div_page=document.getElementById('page');
var div_h1=div_page.firstChild;
var body = document.getElementsByTagName('body')[0];
var a_a1 = body.firstChild;
// console.log(one);
// console.log(one.innerHTML);
// console.log(one.textContent);
// console.log(one.innerText);
// console.log(div_h1);
// console.log(a_a1);
/**這裡開始是前端chapter 6 p269的code
 */
var eventhandler = document.getElementById('shoppingList');
if(eventhandler.addEventListener){
  eventhandler.addEventListener('click',function(event){
    itemdrop(event);
  },false);
}else{
  eventhandler.attachEvent('onclick',function(event){
    itemdrop(event);
  });
}
//這個function 最好添加到library中，可以每次使用。
function getTarget(event){
  if(!event){
    event = window.event;
  }
  return event.target || event.srcElement;
}

function itemdrop(event){
  var el_target,el_parent,el_grandparent;
  el_target = getTarget(event);
  el_parent = el_target.parentNode;
  el_grandparent = el_target.parentNode.parentNode;
  // console.log(el_target);
  // console.log(el_parent);
  // console.log(el_grandparent);
  el_grandparent.removeChild(el_parent);
  if(event.preventDefault){
    event.preventDefault();
  }else{
    event.returnValue = false;
  }
}

var el_username = document.getElementById('username');
if(el_username.addEventListener){
  el_username.addEventListener('focusout',function(event){checkLength(event,7);},false);
  el_username.addEventListener('focusin',function(event){explain(event);},false);
}else{
  el_username.attachEvent('onblur',function(event){checkLength(event,7);});
}
function checkLength(event,length){
  var el,noticemessage;
  el=getTarget(event);
  noticemessage = document.getElementById('noticemessage');
  if(el.value.length < length){
    noticemessage.innerHTML = 'your name is to short, it should be at least '+length+'character';
  }else{
    noticemessage = '';
  }
}
function explain(event){
  var noticemessage;
  noticemessage = document.getElementById('noticemessage');
  noticemessage.innerHTML = 'this is for username.';
}

//c06/js/click.js
var msg ="<div class='header'><a id = 'close' href = '#'>close X</a> </div>";
msg += "<div><h2>System maintenance</h2>";
msg += "Our servers are being updated between 3 and 4 a.m. ";
msg += "<br>During this time,there may be minor disruption to service.</div>"

var elnote = document.createElement('div');
elnote.setAttribute('id','note');
elnote.innerHTML = msg;
document.body.appendChild(elnote);

function elnote_close(){
  document.body.removeChild(elnote);
}
var elclose = document.getElementById('close');
elclose.addEventListener('click',function(event){elnote_close(event);},false);

/** c06/js/position.js */
var sx = document.getElementById('sx');
var sy = document.getElementById('sy');
var px = document.getElementById('px');
var py = document.getElementById('py');
var cx = document.getElementById('cx');
var cy = document.getElementById('cy');

function position(event){
  sx.value =event.screenX;
  sy.value =event.screenY;
  px.value =event.pageX;
  py.value =event.pageY;
  cx.value =event.clientX;
  cy.value =event.clientY;
  var msg = "<table id='position'><tr><th>sx </th><th>sy </th><th>px </th><th>py </th><th>cx </th><th>cy </th></tr>";
  msg +="<tr><td id='sx'>"+sx.value+"</td><td id='sy'>"+sy.value+"</td><td id='px'>"+px.value+"</td><td id='py'>"+py.value+"</td><td id='cx'>"+cx.value+"</td><td id='cy'>"+cy.value+"</td></tr></table>";
  // console.log(msg);
  var preventnull = document.getElementById('position');
  // console.log(preventnull);
  preventnull.innerHTML = msg;
}

var el2 = document.getElementById('body');
el2.addEventListener('mousemove',function(event){position(event);},false);

/**c06/js/keypress.js
 * html已經寫好，只需抄寫js p281
 */
var el3;
function charcount(event){
  var textentered,chardisplay,counter,lastkey;
  textentered = document.getElementById('message').value;
  chardisplay = document.getElementById('charactersleft');
  counter = (180-(textentered.length));
  chardisplay.textContent = counter;
  lastkey = document.getElementById('lastkey');
  lastkey.textContent = 'Last key in ASCII code: '+event.keyCode;
}
el3 = document.getElementById('message');
el3.addEventListener('keydown',function(event){
  charcount(event);
},false);



























