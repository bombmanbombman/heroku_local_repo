$(function(){
  $('#ajax1').one('click',function(e){
    $.ajax({
    type: "get",
    url: "example_2.json",
    data: "data",
    dataType: "json",
    // async:false,
    // success: function (response) {
    //   console.log(response.quiz.sport.q1.options);
    //   let content = '';
    //   content +='<p>sport question1: '+response.quiz.sport.q1.question+'</p>';
    //   for(i=0;i<response.quiz.sport.q1.options.length;i++){
    //     content +=`<input class='question1' type='radio' name='question1' value=${response.quiz.sport.q1.options[i]} >${response.quiz.sport.q1.options[i]}<br>`;
    //   }
    //   content +='<p>sport question1: '+response.quiz.maths.q1.question+'</p>';
    //   console.log($('#response.question1').attr('id'));
    //   for(i=0;i<response.quiz.maths.q1.options.length;i++){
    //     content +=`<input type='radio' name='question2' value=${response.quiz.maths.q1.options[i]} >${response.quiz.maths.q1.options[i]}<br>`;
    //   }
    //   content +='<p>sport question1: '+response.quiz.maths.q2.question+'</p>';
    //   for(i=0;i<response.quiz.maths.q1.options.length;i++){
    //     content +=`<input type='radio' name='question3' value=${response.quiz.maths.q2.options[i]} >${response.quiz.maths.q2.options[i]}<br>`;
    //   }
    //   $('#response').append(content);
    // }
    }).then(function (response) {
      console.log(response.quiz.sport.q1.options);
      let content = '';
      content +=`<span id=test>just for test</span><br>`;
      content +='<p>sport question1: '+response.quiz.sport.q1.question+'</p>';
      for(i=0;i<response.quiz.sport.q1.options.length;i++){
        content +=`<input class='question1' type='radio' name='question1' value= "${response.quiz.sport.q1.options[i]}">${response.quiz.sport.q1.options[i]}<br>`;
      }
      content +='<p>sport question1: '+response.quiz.maths.q1.question+'</p>';
      for(i=0;i<response.quiz.maths.q1.options.length;i++){
        content +=`<input type='radio' name='question2' value="${response.quiz.maths.q1.options[i]}">${response.quiz.maths.q1.options[i]}<br>`;
      }
      content +='<p>sport question1: '+response.quiz.maths.q2.question+'</p>';
      for(i=0;i<response.quiz.maths.q1.options.length;i++){
        content +=`<input type='radio' name='question3' value="${response.quiz.maths.q2.options[i]}">${response.quiz.maths.q2.options[i]}<br>`;
      }
      $('#response').append(content);
      // console.log($(`*`).find('input'));
    },function (response){
      console.log('XMLhttprequest state is rejected');
    })
  });
  // $(document).ajaxComplete(function(event,jqXHR,plainobject){
  //   $('#response').prepend(`<span id=test>just for test</span><br>`);
  // })
  // console.log($('span#test').attr('id'));
  // console.log($(`*`));
  // console.log($(`*`).find('input'));

//geolocation test
var elMap = document.getElementById('loc');                 // HTML element
var msg = 'Sorry, we were unable to get your location.';    // No location msg
$('div#geolocation_ button').on('click',function(e){
  // if (Modernizr.geolocation) {                                // Is geo supported
  if (navigator.geolocation) {                                // Is geo supported
    navigator.geolocation.getCurrentPosition(success, fail);  // Ask for location
    elMap.textContent = 'Checking location...';               // Say checking...
  } else {                                                    // Not supported
    elMap.textContent = msg;                                  // Add manual entry
  }

  function success(position) {                                // Got location
    // msg = '<h3>Longitude:<br>';                               // Create message
    // msg += position.coords.longitude + '</h3>';               // Add longitude
    // msg += '<h3>Latitude:<br>';                               // Create message
    // msg += position.coords.latitude + '</h3>';                // Add latitude
    // elMap.innerHTML = msg;                                    // Show location
    msg = 
    `<h3>Longitude:<br>${position.coords.longitude}</h3>
    <h3>Latitude:<br>${position.coords.latitude}</h3>`;                // Add latitude
    elMap.innerHTML = msg;                                    // Show location
    console.log(position);
  }

  function fail(msg) {                                        // Not got location
    elMap.textContent = msg;                                  // Show text input
    console.log(msg.code);                                    // Log the error
  }

  console.log($('#loc'));
})
/**localStorage object */
// This example has been updated to use Modernizr - please note the use of localstorage in lowercase
// if (Modernizr.localstorage) {
// if (window.localStorage) {
// 
  // var txtUsername = document.getElementById('username'); // Get form elements
  // var txtAnswer = document.getElementById('answer');
// 
  // txtUsername.value = localStorage.getItem('username');  // Elements populated
  // txtAnswer.value = localStorage.getItem('answer');      // by localStorage data
// 
  // txtUsername.addEventListener('input', function () {    // Data saved on keyup
    // localStorage.setItem('username', txtUsername.value);
  // }, false);
// 
  // txtAnswer.addEventListener('input', function () {      // Data saved on keyup
    // localStorage.setItem('answer', txtAnswer.value);
  // }, false);
  // console.log('localStorage exist');
// }
// if(Modernizr.sessionstorage){
// if (window.sessionStorage) {
// 
  // var txtUsername2 = document.getElementById('username2'),  // Get form elements
      // txtAnswer2 = document.getElementById('answer2');
// 
  // txtUsername2.value = sessionStorage.getItem('username2'); // Elements populated
  // txtAnswer2.value = sessionStorage.getItem('answer2');     // by sessionStorage
// 
  // txtUsername2.addEventListener('input', function () {     // Save data on keyup
    // sessionStorage.setItem('username2', txtUsername2.value);
  // }, false);
// 
  // txtAnswer2.addEventListener('input', function () {       // Save data on keyup
    // sessionStorage.setItem('answer2', txtAnswer2.value);
  // }, false);
  // console.log('sessionStorage exist');
// }
//先刪除上次的 webstorage api 中的內容
// localStorage.clear();
// sessionStorage.clear();
// console.log(history)
// document.getElementById('test_click').addEventListener('click',function(){
//   console.log(window.localStorage);
//   console.log(window.sessionStorage);
// })
/**ajax load page 部分 */
// $(function(){
  // function loadContent(url){
    // $('section#a_content').load(`${url} section#a_content`).hide().fadeIn('slow');
  // }
  // $('nav a').on('click',function(e){
    // e.preventDefault();
    // var href = this.href;
    // var $this = $(this);
    // $('a').removeClass('current');
    // $this.addClass('current');
    // loadContent(href);
    // history.pushState('',$this.text,href);
  // });
  // window.onpopstate = function(){
    // var path = location.pathname;
    // loadContent(path);
    // var page = path.substring(location.pathname.lastIndexOf('/')+1);
    // $('nav a').removeClass('current');
    // $(`[href='${page}']`).addClass('current');
    // console.log(history.length);
  // };
// });

});
