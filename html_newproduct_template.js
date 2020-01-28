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
      if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position){
        lat=position.coords.latitude;
        lng=position.coords.longitude;
        });
      }else{
        var lat =35.059823;
        var lng =135749073;
      }
      // let location = {
      //   lat: lat,
      //   lng: lng
      // };

      this.map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: lat,
          lng: lng
        },
        zoom: 16
      });
    },
    // 地址自動完成 + 地圖的中心移到輸入結果的地址上
    siteAuto() {

      let options = {
        componentRestrictions: { country: 'jp' } // 限制在日本範圍
      };
      this.autocomplete = new google.maps.places.Autocomplete(this.$refs.site, options);
      this.autocomplete.addListener('place_changed', () => {
        this.place = this.autocomplete.getPlace();
        if(this.place.geometry) {
          let searchCenter = this.place.geometry.location;
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
    }
  },
  mounted() {
    window.addEventListener('load', () => {

      this.initMap();
      this.siteAuto();

    });
  }
});