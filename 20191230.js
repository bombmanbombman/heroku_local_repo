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
// /** */
var msg ='today is a rainy day ';
msg += 'i bring the rain coat,but still i have been wetted partically.;'
// console.log(msg);
function thisisfortest(){
  globalvariable = 'global';
  var localvariable = 'local';
}
thisisfortest();
// console.log(globalvariable);
// console.log(localvariable);
// someanchor = document.getElementById('thislink');
// console.log(someanchor.href);
// console.log(thislink.href)
// console.log(window.history.length);
// console.log(window.history.go(1));
// console.log(window.location='http://oreilly.com');
var order_array =[1,2,3,4,5,6,7,8,10];
order_array.push('11');
order_array.pop();
order_array.shift();
order_array.unshift('1');
order_array.splice(0,1,1);
order_array.splice(8,0,9);
// console.log(order_array);
assoc_array_class={
  property1:'value1',
  property2:'value2',
  methodname(){
    return this.property1+' '+this.property2;
  }
}
assoc_array_class.property3='value3';
assoc_array_class.methodname2=function(){return this.property1+' '+this.property2+' '+this.property3};
somestring = assoc_array_class.methodname2();
somestring = somestring.replace('value1','value0');
// console.log(somestring);
var dom_tree = document.getElementsByTagName('*');
// dom_tree[5].href = '20191224.php';
// console.log(dom_tree);
// console.log(thislink);
// console.log(thislink2);
// console.log(thislink3);
// document.write(true+'<br>');
// document.write(false+'<br>');
// order_array=[];
// assoc_array_class={};
if(-0||+0||''||null||undefined||NaN||assoc_array_class){
  // document.write('is active<br>');
  // document.write(NaN);
  // if(NaN)document.write('NaN is equal to false')
  // document.write(-0||+0||''||null||undefined||NaN||assoc_array_class+'<br>');
}
variable1 = -0||+0||''||null||undefined||NaN;
variable2 = (variable1 || true) ;
// console.log(variable1+' '+variable2+'<br>');
/**
 * if else if else
 * for($initial;condition;increment)
 * while(){}
 * do{}while{}
 * $variable ? statement1 : statement2;
 * switch($arg)
 *  case value1:
 */
console.log(assoc_array_class);
// var keyname_alias;
for(keyname_alias in assoc_array_class){
  console.log(typeof(assoc_array_class[keyname_alias]))
  if(typeof(assoc_array_class[keyname_alias])!='function'){
    console.log('property');
    console.log(assoc_array_class[keyname_alias]);
  }else if(typeof(assoc_array_class[keyname_alias]=='function')){
    console.log('method');
    console.log(assoc_array_class[keyname_alias]());
  }
}

// for(keyname_alias of assoc_array_class){
//   console.log(keyname_alias);
// }

// for(keyname_alias in assoc_array_class){
  // console.log(typeof(assoc_array_class[keyname_alias]))
  // if(typeof(assoc_array_class[keyname_alias]=='function')){
    // console.log('function');
    // console.log((function(){assoc_array_class.keyname_alias;})());
  // }
  // if(typeof(assoc_array_class[keyname_alias])!='function'){
    // console.log('property');
    // console.log(assoc_array_class[keyname_alias]);
  // }
// }


// for(keyname_alias in order_array){
  // console.log(order_array[keyname_alias]);
// }
// var pokemon = 'ライチュウ';
// function sing(){
//    //JavaScriptは関数内のどこでもvarの宣言を書ける
//    //これらの変数は関数のどこで定義しても、先頭で定義したものとして見なされる
//    //var pokemon;
//   console.log(pokemon);
//   var pokemon = 'ピカチュウ';
//   console.log(pokemon);
// }
// sing();
const test = 'hoge5';

if (true) {
  let test = 'hoge';  //這裡是使用var 所以是global variable
}
if (true) {
  const test = 'hoge2';   //block_variable必須立刻 initialize 不然 invoke 出現error
  console.log(test)   
}
function variable_scope(){
  if(true){
    console.log(test); //這裡的test 是繼承localvarialbe，但是沒有 initialize 所以undefined
  }
  if(true){
    const test = 'hoge4'; // const 使用後 成為了獨立的block scope，不能在block scope invoke undefined block variable
    console.log(test); 
  }
  var test ='hoge3'
}
variable_scope();
console.log(test);  // global scope中 只能 invoke global variable



