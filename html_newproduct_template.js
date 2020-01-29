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
          $("#google_map").html(data);
        }).fail(function(error){
          console.log(error);
        });
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
        let options = {
          componentRestrictions: { country: 'jp' } // 限制在日本範圍
        };
        // $.ajax({
          // url:"html_newproduct_template2.php"
        // }).done(function(data){
          // console.log(data);
          // console.log(typeof(data));
          // $("#google_map").html(data);
        // }).fail(function(error){
          // console.log(error);
        // });
        this.place = this.autocomplete.getPlace();
        
        if(this.place.geometry) {
          let searchCenter = this.place.geometry.location;
          console.log(this.place.geometry.location);
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