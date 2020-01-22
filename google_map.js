
var map, infoWindow;
function initMap() {
  let geo_loc={
    lat: 35.059823,
    lng: 135.749073
  };

  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 35.059823, lng: 135.749073},
    zoom: 12,
    heading: 90,
    tilt: 45,
    scaleControl:true
  });
  let marker1= new google.maps.Marker({
    position:geo_loc,
    map:map
  });
  infoWindow = new google.maps.InfoWindow;

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('現在地');
      infoWindow.open(map);
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}

