$(function(){
    $('#background').css({
        "background-image": `url("upload_compress/background_water4.jpg")`,
        //device 的全屏 desktop 是整个显示器的解析度
        "height": '100vh',
        "width": "100%",
        "position":"absolute",
        "z-index":"-1",
        "background-repeat":"no-repeat"
    });
    $("section#flex_container").css({
        "height":"100vh",
        "width":"100%",
        "margin-top":"25%"
    })
    $('#content').css({
        "position":"relative"
    })
    if($('a#japanese').hasClass('active')){
        $("#log_in_button").css({
            "margin-right":"-75px"
        })
    }
    $("a#japanese").on('click',function(e){
        console.log(e.target);
        $("#log_in_button").css({
            "margin-right":"-75px"
        })
    })
    if($('a#chinese').hasClass('active')){
        $("#log_in_button").css({
            "margin-right":"-45px"
        })
    }
    $("a#chinese").on('click',function(e){
        console.log(e.target);
        $("#log_in_button").css({
            "margin-right":"-45px"
        })
    })
    if($('a#enlgish').hasClass('active')){
        $("#log_in_button").css({
            "margin-right":"-60px"
        })
    }
    $("a#english").on('click',function(e){
        console.log(e.target);
        $("#log_in_button").css({
            "margin-right":"-60px"
        })
    })
    // event resize() to adjust to browser 包括拖动console 的窗口 都会触发
    $(window).resize(function(){ 
        $('#background').css({
            // viewport最大范围
            "height": $(window).outerHeight(true),
            "width": $(window).outerWidth(true),
            "position":"absolute",
            "z-index":"-1",
        });
        console.log('innerHeight:'+$(window).innerHeight());
        console.log('innerWidth:'+$(window).innerWidth());
        console.log('outerHeight:'+$(window).outerHeight(true));
        console.log('outerWidth:'+$(window).outerWidth(true));
    });
    console.log($("*"));
    console.log(document.getElementsByTagName('*'));
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
    //(2)google signin api 的 onSignIn event
    // function init(){
    //   // 载入 google sign in js 文件时自动创建 gapi object
    //   console.log(gapi);
    //   gapi.load('auth2',function(){
    //     gapi.auth2.init({
    //       client_id: 'CLIENT_ID.apps.googleusercontent.com',
    //       fetch_basic_profile: false,
    //       scope: 'profile'
    //         // Sign the user in, and then retrieve their ID.
    //     });
    //     console.log(gapi.auth2.GoogleAuth);
    //     gapi.auth2.signIn().then(function() {
    //       console.log(auth2.currentUser.get().getId());
    //     });
    //   });
    // }
    // function onSignIn(googleUser) {
    //   var profile = googleUser.getBasicProfile();
    //   console.log('ID: ' + profile.getId()); 
    //   // Do not send to your backend! Use an ID token instead.
    //   console.log('Full Name: ' + profile.getName());
    //   console.log('Given Name: ' + profile.getGivenName());
    //   console.log('Family Name: ' + profile.getFamilyName());
    //   console.log('Name: ' + profile.getName());
    //   console.log('Image URL: ' + profile.getImageUrl());
    //   console.log('Email: ' + profile.getEmail()); 
    //   // This is null if the 'email' scope is not present.
    //   var id_token = googleUser.getAuthResponse().id_token;
    //   console.log("ID Token: " + id_token);
    //   // The ID token you need to pass to your backend:
    // }
    // $('#google_sign_out').on('click',function onsingOut(e){
    //   auth2.signOut().then(function () {
    //     console.log('User signed out.');
    //   }); 
    // })
    $('#index_submit').on('submit',function(e){
        e.preventDefault();
        let user_name=$('#user_name').val();
        console.log(user_name)
        let user_password=$('#user_password').val();
        console.log(user_password)
        $.ajax({
            type: "POST",
            url: "index_submit.php",
            data: {
                user_name:user_name,
                user_password:user_password
            },
            dataType: "",
            // success: function (data) {
            //   console.log(data);
            //   if(data =='1'){
                    // window.location.href='html_userdetail_template.php';
            //   }else if(data == '0'){
            //     if($('a#chinese').hasClass('active')){
            //     $('#error_message').text('用戶名或密碼錯誤');
            //     }else if($('a#japanese').hasClass('active')){
            //     $('#error_message').text('ユーザー名又はパスワードが間違っています');
            //     }else if($('a#english').hasClass('active')){
            //       $('#error_message').text('username or password is not corrent');
            //     }
            //   }
            // }
        }).done(function(data){
            console.log('結果是:'+data);
            if(data !='error0'){
                let array=data.split('||');
                // $.cookie('user_id',array[0]);
                // console.log(array);
                $('#error_message').css({
                    "color":"#ff4000"
                });
                if($('a#chinese').hasClass('active')){
                    $('#error_message').text('歡迎回來 '+array[1]).show(0);
                    }else if($('a#japanese').hasClass('active')){
                        $('#error_message').text('おかえり、'+array[1]+'さん').show(0);
                    }else if($('a#english').hasClass('active')){
                        $('#error_message').text('welcome back '+array[1]).show(0);
                    }
                console.log($.cookie());
                window.location.href='html_userdetail_template.php';
            }else if(data == 'error0'){
                $('#error_message').css({
                    "color":"red"
                });
                if($('a#chinese').hasClass('active')){
                $('#error_message').text('用戶名或密碼錯誤').show(0).hide(5000);
                }else if($('a#japanese').hasClass('active')){
                $('#error_message').text('ユーザー名又はパスワードが間違っています').show(0).hide(5000);
                }else if($('a#english').hasClass('active')){
                    $('#error_message').text('username or password is not corrent').show(0).hide(5000);
                }
            }
        }).fail(function(error){
            console.log(error);
        });
    })

    $('#admin').on('click',function(e){
        e.preventDefault();
        let user_name='admin';
        console.log(user_name);
        let user_password='63079861';
        console.log(user_password);
        $.ajax({
            type: "POST",
            url: "index_submit.php",
            data: {
                user_name:user_name,
                user_password:user_password
            },
            dataType: "",
            // success: function (data) {
            //   console.log(data);
            //   if(data =='1'){
                    // window.location.href='html_userdetail_template.php';
            //   }else if(data == '0'){
            //     if($('a#chinese').hasClass('active')){
            //     $('#error_message').text('用戶名或密碼錯誤');
            //     }else if($('a#japanese').hasClass('active')){
            //     $('#error_message').text('ユーザー名又はパスワードが間違っています');
            //     }else if($('a#english').hasClass('active')){
            //       $('#error_message').text('username or password is not corrent');
            //     }
            //   }
            // }
        }).done(function(data){
            console.log('結果是:'+data);
            if(data !='error0'){
                let array=data.split('||');
                // $.cookie('user_id',array[0]);
                // console.log(array);
                $('#error_message').css({
                    "color":"#ff4000"
                });
                if($('a#chinese').hasClass('active')){
                    $('#error_message').text('歡迎回來 '+array[1]).show(0);
                    }else if($('a#japanese').hasClass('active')){
                        $('#error_message').text('おかえり、'+array[1]+'さん').show(0);
                    }else if($('a#english').hasClass('active')){
                        $('#error_message').text('welcome back '+array[1]).show(0);
                    }
                console.log($.cookie());
                window.location.href='html_userdetail_template.php';
            }else if(data == 'error0'){
                $('#error_message').css({
                    "color":"red"
                });
                if($('a#chinese').hasClass('active')){
                    $('#error_message').text('用戶名或密碼錯誤').show(0).hide(5000);
                }else if($('a#japanese').hasClass('active')){
                    $('#error_message').text('ユーザー名又はパスワードが間違っています').show(0).hide(5000);
                }else if($('a#english').hasClass('active')){
                    $('#error_message').text('username or password is not corrent').show(0).hide(5000);
                }
            }
        }).fail(function(error){
            console.log(error);
        });
    })
});