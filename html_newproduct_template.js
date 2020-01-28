$(function(){
  const googleMap = new Vue({
    el: '#app',
    data: {
      map: null,
      autocomplete: null, // google map Autocomplete method
      site: '', // place API要綁定的搜尋框
      place: null // 存place確定後回傳的資料
    },
    methods: {
      // init google map
      initMap() {
  
        let location = {
          lat: 25.0374865,
          lng: 121.5647688
        };
  
        this.map = new google.maps.Map(document.getElementById('map'), {
          center: location,
          zoom: 16
        });
        
      },
      // 地址自動完成 + 地圖的中心移到輸入結果的地址上
      siteAuto() {
  
        let options = {
          componentRestrictions: { country: 'tw' } // 限制在台灣範圍
        };
        this.autocomplete = new google.maps.places.Autocomplete(this.$refs.site, options);
        
        // 地址的輸入框，值有變動時執行
        this.autocomplete.addListener('place_changed', () => {
          this.place = this.autocomplete.getPlace(); // 地點資料存進place
          
          // 確認回來的資料有經緯度
          if(this.place.geometry) {
            
            // 改變map的中心點
            let searchCenter = this.place.geometry.location;
            
            // panTo是平滑移動、setCenter是直接改變地圖中心
            this.map.panTo(searchCenter);
  
            // 在搜尋結果的地點上放置標記
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
  })
});