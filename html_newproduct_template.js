const googleMap = new Vue({
  el: '#app',
  data: {
    map: null,
    autocomplete: null,
    site: '', // place API要綁定的搜尋框
    place: null // 存place確定後回傳的資料
  },
  methods: {
    // init google map
    initMap() {
      geo_loc = {
        lat: 35.059823,
        lng: 135.749073
      };
      this.map = new google.maps.Map(document.getElementById('map'), {
        center: geo_loc,
        zoom: 16,
        scaleControl:true
      });
      
      let marker1= new google.maps.Marker({
        position:geo_loc,
        map:this.map
      });
      $('#echo8').on('click',function(){
        $.ajax({
          url:"html_newproduct_template2.php"
        }).done(function(data){
          console.log(data);
          console.log(typeof(data));
          $("#show_map").html(data);
        }).fail(function(error){
          console.log(error);
        });
        this.map = new google.maps.Map(document.getElementById('map'), {
          center: geo_loc,
          zoom: 16,
          scaleControl:true
        });
        click_switch = true;
        $('#show_map').empty()

        // if(typeof(change_switch)==='undefined'){change_switch=false;}
        // else if(change_switch==true){
        //   // location.reload();
        //   $("#map1").attr('display','none');
        //   $("#map2").removeAttr('display');
        //   change_switch = false;
        // }
        infoWindow = new google.maps.InfoWindow;
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (position) {
            var geo_loc = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            this.map = new google.maps.Map(document.getElementById ('map'), {
              center: geo_loc,
              zoom: 16,
              scaleControl:true
            });
            let marker1= new google.maps.Marker({
              position:geo_loc,
              map:this.map
            });
            $('#value2').val('現在地||current place');
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
            $('#comment').empty();
            console.log($('*'));
            // infoWindow.setPosition(pos);
            // infoWindow.setContent('現在地');
            // infoWindow.open(this.map);
            // map.setZoom(15);
            // map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter ());
          });
          
        }
      })
    },
    
    // 地址自動完成 + 地圖的中心移到輸入結果的地址上
    siteAuto() {
      $('#search').on('focus',function(e){
        console.log(e.target);
        if(typeof(click_switch)==='undefined'){
          click_switch=false;
        }else if(click_switch==true){
          $('#google_map_js').remove('#google_api_js');
          $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyB5lki3Wn7GU8gZllmCyWc9VgkVDrH-_OA&libraries=places&callback=initMap");
        }
      })
      this.map = new google.maps.Map(document.getElementById('map'), {
        center: geo_loc,
        zoom: 16,
        scaleControl:true
      });
      let options = {
        componentRestrictions: { country: 'jp' } // 限制在日本範圍
      };
      this.autocomplete = new google.maps.places.Autocomplete(this.$refs.site, options);
      this.autocomplete.addListener('place_changed', () => {
        this.map = new google.maps.Map(document.getElementById('map'), {
          center: geo_loc,
          zoom: 16,
          scaleControl:true
        });
        change_switch = true;
        if(typeof(click_switch)==='undefined'){click_switch=false;}
        else if(click_switch==true){
          // $('#show_map').empty()
          location.reload();
          // $.ajax({
          //   url:"html_newproduct_template3.php"
          // }).done(function(data){
          //   console.log(data);
          //   console.log(typeof(data));
          //   $("#show_map").html(data);
          // }).fail(function(error){
          //   console.log(error);
          // });
          this.map = new google.maps.Map(document.getElementById('map'), {
            center: geo_loc,
            zoom: 16,
            scaleControl:true
          });
          let options = {
            componentRestrictions: { country: 'jp' } // 限制在日本範圍
          };
          this.autocomplete = new google.maps.places.Autocomplete(this.$refs.site, options);
          console.log(this.autocomplete);
          this.place = this.autocomplete.getPlace();
          // location.reload();
          // $("#map2").attr('display','none');
          // $("#map1").removeAttr('display');
          // $("#map2").fadeToggle(0);
          // $("#map1").fadeToggle(1000);
          click_switch = false;
        }
        this.map = new google.maps.Map(document.getElementById('map'), {
          center: geo_loc,
          zoom: 16,
          scaleControl:true
        });
        let options = {
          componentRestrictions: { country: 'jp' } // 限制在日本範圍
        };
        console.log(this.autocomplete.__e3__);
        console.log(this.autocomplete.__ob__);
        console.log(this.autocomplete.gm_accessors_);
        console.log(this.autocomplete.gm_bindings_);
        this.place = this.autocomplete.getPlace();
        console.log(this.place);
        console.log("order array||"+this.place.address_components);
        console.log(this.place.adr_address);
        console.log(this.place.formatted_address);
        console.log(this.place.geometry);
        console.log(this.place.html_attributions);
        console.log(this.place.icon);
        console.log(this.place.id);
        console.log(this.place.name);
        console.log("order array||"+this.place.photos);
        console.log(this.place.place_id);
        console.log("assoc object||"+this.place.plus_code);
        // console.log("assoc object||"+this.place.plus_code.compound_code);
        // console.log("assoc object||"+this.place.plus_code.global_code);
        console.log(this.place.rateing);
        console.log(this.place.reference);
        console.log("order array||"+this.place.reviews);
        console.log(this.place.scope);
        console.log(this.place.opening_hours);
        console.log(this.place.website);
        console.log(this.place.type);
        console.log(this.place.place_id);
        if(this.place.geometry) {
          console.log(this.place.geometry);
          let searchCenter = this.place.geometry.location;
          console.log(this.place.geometry.viewport);
          console.log(this.place.geometry.location);
          console.log(this.place.geometry.location.lat());
          console.log(this.place.geometry.location.lng());
          this.map.panTo(searchCenter); // panTo是平滑移動、setCenter是直接改變地圖中心
          
          // 放置標記
          let marker = new google.maps.Marker({
            position: searchCenter,
            map: this.map
          });

          // info window
          let infowindow = new google.maps.InfoWindow({
            content: this.place.formatted_address
          });
          infowindow.open(this.map, marker);
          
          //獲得坐標，名稱
          console.log(this.place.name);
          $('#value2').val(this.place.formatted_address);
          $('#latitude').val(this.place.geometry.location.lat());
          $('#longitude').val(this.place.geometry.location.lng());
          console.log($('*'));
        }
      });
    },
  },
  mounted() {
    window.addEventListener('load', () => {

      this.initMap();
      this.siteAuto();

    });
  }
});