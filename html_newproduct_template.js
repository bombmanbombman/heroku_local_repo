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