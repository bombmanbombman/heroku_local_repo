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

      let location = {
        lat: 35.059823,
        lng: 135.749073
      };

      this.map = new google.maps.Map(document.getElementById('map'), {
        center: location,
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