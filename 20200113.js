document.getElementById('get_json_text').addEventListener('click',get_json_text);
document.getElementById('get_json_json').addEventListener('click',get_json_json);
document.getElementById('get_json_jsonp').addEventListener('click',get_json_jsonp);
document.getElementById('post_json_jsonp').addEventListener('submit',post_json_jsonp);
function get_json_text(){
  fetch('fetch.txt')
  .then(function(res){
    console.log(res);
    // console.log(res.text());
    return res.text();
  })
  .then(function(data){
    console.log(data);
    document.getElementById('fetch_api_output').innerHTML=data;
  })
  .catch(error=>{console.log(error)})
}
function get_json_json(){
  fetch('example_3.json')
  .then((res)=> res.json())
  .then(function(data){
    let output='<h6>fetch json</h6>';
    console.log(data);
    data.forEach(element => {
      output+=`
      <ul class='list-group mb-3'>
        <li class='list-group-item'>ID:${element.id}</li>
        <li class='list-group-item'>Name:${element.name}</li>
        <li class='list-group-item'>Email:${element.email}</li>
      </ul>
      `
    });
    document.getElementById('fetch_api_output').innerHTML=output;
  })
  .catch(error=>{console.log(error)})
}
function get_json_jsonp(){
  fetch('https://jsonplaceholder.typicode.com/posts')
  .then((res)=> res.json())
  .then(function(data){
    let output='<h4 class="mb-4">jsonplaceholder 練習題post</h4>';
    console.log(data);
    data.forEach(element => {
      output+=`
      <h3>${element.title}</h3>
      <ul class='card card-body mb-3'>
        <li>userID:${element.userId}</li>
        <li>ID:${element.id}</li>
        <li>Body:${element.body}</li>
      </ul>
      `
    });
    document.getElementById('fetch_api_output').innerHTML=output;
  })
  .catch(error=>{console.log(error)})
}
function post_json_jsonp(e){
  e.preventDefault();
  // let post_title = $('#post_title').val();
  // let post_body = $('#post_body').val();
  let post_title = document.getElementById('post_title').value;
  let post_body = document.getElementById('post_body').value;
  fetch('https://jsonplaceholder.typicode.com/posts',{
    method:"POST",
    headers:{
      "Accept":"application/json, text/plain, */*",
      "Content-type":"application/json"
    },
    body:JSON.stringify({title:post_title,body:post_body})
  })
  .then((res)=> res.json())
  .then(function(data){
    console.log(data);
  })
  .catch(error=>{console.log(error)})
}
$(function(){
  console.log($('*'));
  let variable_js="<?php echo $string?>";
  console.log(variable_js);
});
// document.getElementsByClassName('js_to_php').addEventListener('submit',redirect)
// function redirect(){
  // let js_to_php='i am in js,how about you?';
  // $.post('get_variable_from_js.php',{js_to_php:js_to_php});
// }
$(function(){
  $('#userage').on("input",function(e){
    var username =$('#username').val();
    var userage=$('#userage').val();
    $.post('get_variable_from_js.php',{username:username,userage:userage})
    .done(function(data){
      console.log(data);
      if(data=='1'){
        $('#result').html('you are qualified');
      }else if(data=='0'){
        $('#result').html('you are not qualified to do this')
      }
    })
  })                 
})
$(function(){
  $('#RandomCat').on('click',function(e){
    e.preventDefault();
    $.ajax({
      type:'GET',
      url:"https://aws.random.cat/meow",
    })
      .done(function(data){
        console.log(data);
        $('#cat_image').html(`<img src='${data.file}' alt='failed' style='width:80%;'>`).hide('fast').show('slow')
      })
      .fail(function(error){
        console.log(error);
      });
  })
});
$(function(){
  $('#randomfox').on('click',function(e){
    e.preventDefault();
    $.ajax({
      type:'GET',
      url:"https://random.dog/woof.json",
    })
      .done(function(data){
        console.log(data);
        $('#cat_image').html(`<img src='${data.url}' alt='failed' style='width:80%;'>`).hide().show()
      })
      .fail(function(error){
        console.log(error);
      });
  })
});
$(function(){
  $('#fashion').on('click',function(e){
    e.preventDefault();
    $.ajax({
      type:'GET',
      url:"https://samples.clarifai.com/apparel.jpeg",
      xhrFields:{
        responseType:'blob'
      }
    })
      .done(function(data){
        var blobdata =data;
        var url = window.URL||window.webkitURL;
        var src = url.createObjectURL(data);
        console.log(data);
        console.log(typeof(data));
        $('#cat_image').html(`<img src='${src}' alt='failed' style='width:80%;'>`);
      })
      .fail(function(error){
        console.log(error);
      });
  })
  $('#OMDb').on('submit',function(e){
    user_input_year=$('#user_input_title').val();
    e.preventDefault();
    $.ajax({
      type:'GET',
      url:`http://www.omdbapi.com/?t=${user_input_year}&apikey=4f9851cc`
    })
      .done(function(data){
        console.log(data);
        if(data.Response=='False'){
          $('#cat_image').html('<h6>movie not found</h6>')
        }else{
        $('#cat_image').html(`<img src='${data.Poster}' alt='failed' style='width:80%;'>`);
        }
      })
      .fail(function(error){
        console.log(error);
      });
  })
});
// fetch('20200113.php',{
  // method:"POST",
  // headers:{
// 
  // },
  // body:JSON.stringify({js_to_php:'i am in js,how about you?'})
  // .then(res=>res.json)
  // .then(data=>{console.log(data);})
  // .catch(error=>{console.log(error);})
// })
$(function(){
  // setTimeout(() => {
  //   $.ajax({
  //     type:'GET',
  //     url:"https://aws.random.cat/meow"
  //   })
  //   .done(function(data){
  //     console.log(data);
  //     console.log(data.url);
  //     console.log(data.url.search('mp4'));
  //     dog_pic=data.url.search('mp4');
  //     while(dog_pic != '-1'){
  //       setTimeout(() => {
  //         $.ajax({
  //         type:'GET',
  //         url:"https://aws.random.cat/meow"
  //         })
  //         .done(function(data){
  //           dog_pic=data.url.search('mp4');
  //           console.log(dog_pic);
  //         })
  //         .fail(function(error){
  //           console.log(error);
  //         });
  //       },2000)
  //       var i=0
  //       console.log(++i)
  //     };
  //     $('#slide_image1').attr('src',data.file);
  //   })
  //   .fail(function(error){
  //     console.log(error);
  //   });
  // }, 1000)

});

$(function(){
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 35.116, lng: 135.768},
      zoom: 10
    });
    let geo_loc={
      lat: 35.31940,
      lng: 135.748047
    };
    let marker1= new google.maps.Marker({
      position: geo_loc,
      map: map
    });
  };
});

