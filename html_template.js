//(-1)添加背景圖
$(function(){
  
  if(document.URL){
    console.log(document.URL);
    var URL = document.URL;
  }else{
    console.log(window.location.href);
    var URL = window.location.href;
  }
  if(URL.search('herokuapp.com')!=-1){

  }
  $('body').css({
    "background-image": `url("/upload_compress/background_water4.jpg")`,
    //device 的全屏 desktop 是整个显示器的解析度
    // "height": '110vh',
    // "width": "100%",
    "background-size":"cover",
    "position":"absolute",
    "z-index":"-1",
    "background-repeat":"no-repeat"
  });

  //(1)water ripple effect相关
  $('body').ripples({
    // Image Url
    imageUrl: '/upload_compress/background_water4.jpg',
    // The width and height of the WebGL texture to render to.
    // The larger this value, the smoother the rendering and the slower the ripples wilpropagate.
    resolution: 256,
        // The size (in pixels) of the drop that results by clicking or moving the mouse ovethe canvas.
    dropRadius: 20,
    // Basically the amount of refraction caused by a ripple.
    // 0 means there is no refraction.
    perturbance: 0.04,
    // Whether mouse clicks and mouse movement triggers the effect.
    interactive: true,
    // The crossOrigin attribute to use for the affected image.
    crossOrigin: ''
  });
  // $('.demo').ripples('drop', x, y, radius, strength);
  $("section").ripples('show');
});

//(0)在<head>添加各种js的library ,不能使用defer async 来不及加载，就会执行下面的code。
// let jquery_file=document.createElement('script');
// jquery_file.id='jquery';
// jquery_file.src='jquery-3.4.1.js';
// //由于下面的code 需要jquery，所以这里不能是defer或asynce
// // jquery_file.defer='';
// // jquery_file.async='';
// let headtag=document.getElementsByTagName('head');
// // console.log(headtag);
// // console.log(jquery_file);
// headtag[0].appendChild(jquery_file);
// let jquery_ui=document.createElement('script');
// jquery_ui.id='jquery_ui';
// jquery_ui.src='jquery-ui-1.12.min.js';
// headtag[0].appendChild(jquery_ui);
// let bootstrap_js=document.createElement('script');
// bootstrap_js.id='bootstrap_js';
// bootstrap_js.src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js';
// headtag[0].appendChild(bootstrap_js);
// let vue=document.createElement('script');
// vue.id='vue';
// vue.src='vue.min.js';
// headtag[0].appendChild(vue);

$(function(){
  //(1)carousel 插入
  if($('section#a_content').length){
    $('body').prepend(`
      <div class="container">
        <br>
        <div id="myCarousel" class="carousel slide bg-dark" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active" data-interval='3000'>
              <img id='slide_image1' src="/upload_compress/spinner3.gif" class="d-block w-100"  style='height:300px;' alt="..."> 
              <div class="carousel-caption">
                <h3>Chania</h3>
                <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
              </div>
            </div>
            <div class="carousel-item" data-interval='3000'>
              <img id='slide_image2' src="/upload_compress/spinner3.gif" class="d-block w-100"  style='height:300px;' alt="..."> 
              <div class="carousel-caption">
                <h3>Chania</h3>
                <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
              </div>
            </div>
            <div class="carousel-item" data-interval='3000'>
              <img id='slide_image3' src="/upload_compress/spinner3.gif" class="d-block w-100"  style='height:300px;' alt="..."> 
              <div class="carousel-caption">
                <h3>Flowers</h3>
                <p>Beatiful flowers in Kolymbari, Crete.</p>
              </div>
            </div>
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    `)
    $('.carousel').carousel({interval:5000});

    loop();
    function loop(){
      setTimeout(() => {
        $.ajax({
          type:'GET',
          url:"https://aws.random.cat/meow"
        })
        .done(function(data){
          console.log(data);
          $('#slide_image1').attr('src',data.file);
        })
        .fail(function(error){
          console.log(error);
        });
      }, 1000)
      setTimeout(() => {
        $.ajax({
          type:'GET',
          url:"https://aws.random.cat/meow"
        })
        .done(function(data){
          console.log(data);
          $('#slide_image2').attr('src',data.file);
        })
        .fail(function(error){
          console.log(error);
        });
      }, 2000)
      setTimeout(() => {
        $.ajax({
          type:'GET',
          url:"https://aws.random.cat/meow"
        })
        .done(function(data){
          console.log(data);
          $('#slide_image3').attr('src',data.file);
        })
        .fail(function(error){
          console.log(error);
        });
      }, 3000)
      /**无限loop */
      // setTimeout(() => {
      //   loop();
      // }, 10000);
    }
  }
  //(2)時間表插入 
  // console.log($('a.active').attr('id'));
  if($('section#a_content').length||$('#time_table').length){
    $('#time_table').html(`
      <h4 id='clock' class='border border-warning rounded-pill rounded-lg bg-secondary text-center  text-white'></h4>
    `).css({
      "background-size":"cover"
    })
    clock();
    function foo(x) { return (x < 10) ? '0' + x : x; }
    function clock() {
      var now = new Date();
      // console.log(now);
      // console.log(typeof(now));
      var year=now.getFullYear();
      var month=now.getMonth()+1;
      var day=now.getDate();
      var weekday=now.getDay();
      if($('a.active').attr('id')=='japanese'){
        switch (weekday) {
          case 0:
            weekday='日曜日'
            break;
          case 1:
            weekday='月曜日'
            break;
          case 2:
            weekday='火曜日'
            break;
          case 3:
            weekday='水曜日'
            break;
          case 4:
            weekday='木曜日'
            break;
          case 5:
            weekday='金曜日'
            break;
          case 6:
            weekday='土曜日'
            break;                                
          default:
            break;
        }
        var hour = now.getHours();
        hour=foo(hour);
        var minute = now.getMinutes();
        minute=foo(minute);
        var second = now.getSeconds();
        second=foo(second);
        var millisecond = now.getMilliseconds();
        var time =year+'年 '+month+'月 '+day+'日 '+weekday+' '  +hour+'時'+minute+'分'+second+'秒';
        // console.log(time);
        var t = foo(hour) + ':' + foo(minute) + ':' + foo (second);
        document.getElementById('clock').innerText = time;
        setTimeout(() => {
          clock();
        }, 980);
      }else if($('a.active').attr('id')=='chinese'){
        switch (weekday) {
          case 0:
            weekday='星期天'
            break;
          case 1:
            weekday='星期一'
            break;
          case 2:
            weekday='星期二'
            break;
          case 3:
            weekday='星期三'
            break;
          case 4:
            weekday='星期四'
            break;
          case 5:
            weekday='星期五'
            break;
          case 6:
            weekday='星期六'
            break;                                
          default:
            break;
        }
        var hour = now.getHours();
        hour=foo(hour);
        var minute = now.getMinutes();
        minute=foo(minute);
        var second = now.getSeconds();
        second=foo(second);
        var millisecond = now.getMilliseconds();
        var time =year+'年 '+month+'月 '+day+'日 '+weekday+' '  +hour+'時'+minute+'分'+second+'秒';
        // console.log(time);
        var t = foo(hour) + ':' + foo(minute) + ':' + foo (second);
        document.getElementById('clock').innerText = time;
        setTimeout(() => {
          clock();
        }, 980);
      }else if($('a.active').attr('id')=='english'){
        switch (weekday) {
          case 0:
            weekday='sunday'
            break;
          case 1:
            weekday='monday'
            break;
          case 2:
            weekday='tuesday'
            break;
          case 3:
            weekday='wednesday'
            break;
          case 4:
            weekday='thursday'
            break;
          case 5:
            weekday='friday'
            break;
          case 6:
            weekday='saturday'
            break;                                
          default:
            break;
        }
        switch (day) {
          case 1:
            day = day+'st'
            break;
          case 2:
            day = day+'nd'
            break;
          case 3:
            day = day+'rd'
            break;                             
          default:
            day = day+'th'
            break;
        }
        switch (month) {
          case 1:
            month='january'
            break;
          case 2:
            month='february'
            break;
          case 3:
            month='march'
            break;
          case 4:
            month='april'
            break;
          case 5:
            month='may'
            break;
          case 6:
            month='june'
            break;
          case 7:
            month='july'
            break;
          case 8:
            month='august'
            break;      
          case 9:
            month='september'
            break;      
          case 10:
            month='october'
            break;      
          case 11:
            month='november'
            break;      
          case 12:
            month='december'
            break;      
          default:
            break;
        }
        var hour = now.getHours();
        hour=foo(hour);
        var minute = now.getMinutes();
        minute=foo(minute);
        var second = now.getSeconds();
        second=foo(second);
        var millisecond = now.getMilliseconds();
        var time =' '+month+' '+day+' '+year+' '+weekday+' '  +hour+':'+minute+':'+second;
        // console.log(time);
        var t = foo(hour) + ':' + foo(minute) + ':' + foo (second);
        document.getElementById('clock').innerText = time;
        setTimeout(() => {
          clock();
        }, 980);
      }
    }
  }
});

$(function(){
  //（3）用於跳出 alert 告知 syntax error
  onerror=handler;
  function handler(message,url,line){
    pop='something is not right \n\n';
    pop += 'error is :'+message+'\n';
    pop += 'happened in :'+url+'\n';
    pop += 'located in :'+line+'\n';
    alert(pop);
  }
  //（4）用於在其他 eventlistener 的callback 中使用 getTarget(event_alias)
  function getTarget(event){
    if(!event){
      event = window.event;
    }
    return event.target || event.srcElement;
  }
  all_tag=document.getElementsByTagName('*');

  //添加各種需要載入的js文件  与（0）重复了，所以省略
  // if(!$('section#load_js').length){
  //   $('script#js').after(
  //     `<section id='load_js' class='current'>
  //     <!--modernizr 用於 geolocation-->
  //     <script id='jquery' defer='' async='' src="jquery-3.4.1.js"></script>
  //     <script id='jquery_ui' defer='' async='' src='jquery-ui-1.12.min.js'</script>
  //     <script id='vue' defer='' async='' src="vue.min.js"></script>
  //     <script id='bootstrap_js' defer='' async='' src='/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js'></script>
  //     <script type='text/javascript' defer='' async='' src="modernizr.2.7.1.js"></script>
  //     </section>`
  //   );
  // }
  //（6）添加各種 <nav><a></a></nav>對應下面的（4）ajax page load機能
  // nav_anchor=`<nav>
  // <a href='https://bombmanbombman-project1.herokuapp.com/' id='thislink'>go to https://bombmanbombman-project1.herokuapp.com/</a>
  // <br><a href='20191229.php' id='thislink'>go to 20191229.php</a>
  // <br><a href='20191230.php' id='thislink2'>go to 20191230.php</a>
  // <br><a href='20191224.php' id='thislink3'>go to 20191224.php</a>
  // <br><a href='20191231.php' id='thislink3'>go to 20191231.php</a>
  // <br><a href='20200107.php' id='thislink3'>go to 20200107.php</a>
  // <br><a href='20200110.php' id='thislink3'>go to 20200110.php</a>
  // <br><a href='20200113.php' id='thislink3'>go to 20200113.php</a>
  // </nav>`;
  // if(!$('nav').length){
  // $('body').prepend(nav_anchor);
  /**
   *（7） 使用<nav><a src||href></a></nav> 使用ajax asynchronous pag load
   * 帶有 hide().fadeIn('slow')的jq effect效果
   * 在這裡手動添加<nav><a></a></nav>
   * 下面必須是 <section id='a_content' class='current'></section>
   */
  // }
});




$(function(){
  function loadContent(url){
    $('section#a_content').load(`${url} section#a_content`,function(){
      if($('nav a.current').attr('href')){
        phpfilename = $('nav a.current').attr('href');
        jsfilename = phpfilename.replace('php','js');
        console.log(phpfilename);
        console.log(jsfilename);
        if($('script#js').attr('href') != jsfilename){
          $('script#js').remove();
          $('section#load_js').append(`<script id=js src='${jsfilename}'><!--//--></script>`)
        }
      }
    }).hide().fadeIn('slow');
  }
  $('nav a').on('click',function(e){
    e.preventDefault();
    var href = this.href;
    var $this = $(this);
    $('a').removeClass('current');
    $this.addClass('current');
    loadContent(href);
    history.pushState('',$this.text,href);
  });
  //給browser popstate event後，修改 <a></a>的class=‘current’
  window.onpopstate = function(){
    var path = location.pathname;
    // console.log(location);
    // console.log(location.pathname);
    loadContent(path);
    var page = path.substring(location.pathname.lastIndexOf('/')+1);
    // console.log(page);
    $('nav a').removeClass('current');
    $(`[href='${page}']`).addClass('current');
    //用attribute 來 指向特定的element。
    console.log(history.length);
  };

  /**使用 $.ajax 進行 local ajax event */
//   $('nav a').on('click',function(e){
//     e.preventDefault();
//     // var href = this.href;
//     $('nav a.current').removeClass('current')
//     $(this).addClass('current');
//     console.log($('*'));
//     let href = $(this).attr('href');
//     $.ajax({
//       url:`${href}#a_content` ,
//       success:function(data,textStatus,jqXHR){
//         htmlstring = JSON.stringify(data);
//         console.log(data);
//         console.log(textStatus);
//         console.log(jqXHR.responseText);
//         console.log(start=jqXHR.responseText.search('<section'));
//         console.log(end=jqXHR.responseText.search(`</section>`));
//         console.log(part = jqXHR.responseText.substr(start,end));
//         // console.log(typeof(data));
//         // console.log(data.find('section#a_content'));
//         console.log(htmlstring);
//         console.log(start=htmlstring.search('<section'));
//         console.log(end=htmlstring.search(`</section>`));
//         console.log(part = htmlstring.substr(start,end));
//       }
//     });
//   });

});

/**(8) 語言轉換 load html_language_template.json */
$(function(){
  let current_file = location.pathname;
  console.log(current_file);
  let suffix = current_file.search('.php');
  console.log(suffix);
  if(suffix !=-1){
    current_file=current_file.substr(1,suffix-1);
  }
  console.log(current_file);
  $("#japanese").on('click',function(e){
    $('a.actived-language').removeClass('active');
    $('a.actived-language').removeClass('actived-language');
    $('#japanese').addClass('active');
    $('#japanese').addClass('actived-language');
    console.log(e.target);
    $.ajax({
      type: "GET",
      url: "html_language_template.json",
      // url: "example_3.json",
      dataType: "json",
    })
    .then(function(data,textStatus,jqXHR){
      // console.log(data);
      console.log(data.page[current_file].language.japanese);
      language_object=data.page[current_file].language.japanese;
      // language_object=JSON.stringify(language_object);
      // console.log(textStatus);
      // console.log(jqXHR);
    })
    .then(function(){
      console.log(language_object);
      console.log(current_file);
      idname_collection=Object.getOwnPropertyNames(language_object);
      let jq_object=$();
      idname_collection.forEach(function(value){
        jq_object=jq_object.add($('#'+value));
      })
      console.log(jq_object);
      let prop;
      jq_object.fadeOut(1);
      $('body').fadeOut(1);
      for(prop in language_object){
        console.log(prop);
        console.log(prop.search('value'));
        if(prop.search("value"!=-1)){
          $('#'+prop).val(language_object[prop]);
        }
        if(prop.search("value"==0)){
          $('#'+prop).text(language_object[prop]);
        }
        $("#"+prop).fadeIn(1000);
      }
      $('body').fadeIn(1000);
      // document.cookie='language=;max-age=0';
      // document.cookie='language=japanese';
      $.removeCookie('language',{path: '/'});
      $.cookie('language','japanese',{path:'/'});
      console.log($.cookie());
      // location.reload();
      console.log($('*'));
    })
    .fail(function(jqXHR,textStatus,errorThrown){
      console.log('ページ:'+window.location.href+' まだ翻訳されていない、またはjson読み込み失敗した。');
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    });
  })
  $("#chinese").on('click',function(e){
    $('a.actived-language').removeClass('active');
    $('a.actived-language').removeClass('actived-language');
    $('#chinese').addClass('active');
    $('#chinese').addClass('actived-language');
    console.log(e.target);
    $.ajax({
      type: "GET",
      url: "html_language_template.json",
      // url: "example_3.json",
      dataType: "json",
    })
    .then(function(data,textStatus,jqXHR){
      // console.log(data);
      console.log(data.page[current_file].language.chinese);
      language_object=data.page[current_file].language.chinese;
      // language_object=JSON.stringify(language_object);
      // console.log(textStatus);
      // console.log(jqXHR);
    })
    .then(function(){
      console.log(current_file);
      let prop;
      idname_collection=Object.getOwnPropertyNames(language_object);
      let jq_object=$();
      idname_collection.forEach(function(value){
        jq_object=jq_object.add($('#'+value));
      })
      console.log(jq_object);
      jq_object.fadeOut(1);
      $('body').fadeOut(1);
      for(prop in language_object){
        console.log(prop);
        console.log(prop.search('value'));
        if(prop.search("value"!=-1)){
          $('#'+prop).val(language_object[prop]);
        }
        if(prop.search("value"==0)){
          $('#'+prop).text(language_object[prop]);
        }
        $("#"+prop).fadeIn(1000);
      }
      $('body').fadeIn(1000);
      // document.cookie='language=;max-age=0';
      // document.cookie='language=chinese';
      $.removeCookie('language',{path: '/'});
      $.cookie('language','chinese',{path:'/'});
      console.log($.cookie());
      console.log($('*'));
    })
    .fail(function(jqXHR,textStatus,errorThrown){
      console.log('這個頁面:'+window.location.href+' 還沒有翻譯或language.json載入失敗');
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    });
  })
  $("#english").on('click',function(e){
    $('a.actived-language').removeClass('active');
    $('a.actived-language').removeClass('actived-language');
    $('#english').addClass('active');
    $('#english').addClass('actived-language');
    console.log(e.target);
    $.ajax({
      type: "GET",
      url: "html_language_template.json",
      // url: "example_3.json",
      dataType: "json",
    })
    .then(function(data,textStatus,jqXHR){
      // console.log(data);
      console.log(data.page[current_file].language.english);
      language_object=data.page[current_file].language.english;
      // language_object=JSON.stringify(language_object);
      // console.log(textStatus);
      // console.log(jqXHR);
    })
    .then(function(){
      console.log(current_file);
      let prop;
      idname_collection=Object.getOwnPropertyNames(language_object);
      let jq_object=$();
      idname_collection.forEach(function(value){
        jq_object=jq_object.add($('#'+value));
      })
      console.log(jq_object);
      jq_object.fadeOut(1);
      $('body').fadeOut(1);
      for(prop in language_object){
        console.log(prop);
        console.log(prop.search('value'));
        if(prop.search("value"!=-1)){
          $('#'+prop).val(language_object[prop]);
        }
        if(prop.search("value"==0)){
          $('#'+prop).text(language_object[prop]);
        }
        $("#"+prop).fadeIn(1000);
      }
      $('body').fadeIn(1000);
      // document.cookie='language=;max-age=0';
      // document.cookie='language=english';
      console.log($.removeCookie('language',{path: '/'}));
      $.cookie('language','english',{path:'/'});
      console.log($.cookie());
      console.log($('*'));
    })
    .fail(function(jqXHR,textStatus,errorThrown){
      console.log('page:'+window.location.href+'has not translated yet or failed to load language.json');
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    });
  })
  if($.cookie('language')){
    console.log($.cookie());
    console.log($.cookie('language'));
    console.log(typeof($.cookie));
    $('#'+$.cookie('language')).trigger('click');
  }
});
// (9) 檢測 user使用的browser，因為firefox 不支持 input type="time" 要使用插件
$(function(){
    // Opera 8.0+
  var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
  // Firefox 1.0+
  var isFirefox = typeof InstallTrigger !== 'undefined';
  // Safari 3.0+ "[object HTMLElementConstructor]" 
  var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
  // Internet Explorer 6-11
  var isIE = /*@cc_on!@*/false || !!document.documentMode;
  // Edge 20+
  var isEdge = !isIE && !!window.StyleMedia;
  // Chrome 1 - 71
  var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
  // Blink engine detection
  var isBlink = (isChrome || isOpera) && !!window.CSS;

  if(isOpera){
    browser="opera";
  }else if(isFirefox){
    browser="firefox";
  }else if(isSafari){
    browser="safari";
  }else if(isIE){
    browser="ie";
  }else if(isEdge){
    browser="edge";
  }else if(isChrome){
    browser="chrome";
  }else if(isBlink){
    browser="blink";
  }
  console.log(browser);
  if(browser =='firefox'){
    $('#datetime-local').attr('type','date');
    $('#datetime-local').after(`<input name=time_sold type=time>`);
  }
})
//(99)
//global ajax event 任何ajax event 結束後都會執行一次。
$(function(){
  $(document).ajaxComplete(function(event,jqXHR,data){
    console.log($('*'));
  });
}); 


