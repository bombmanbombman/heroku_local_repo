$(function(){
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      // 京都市的location
      center: {lat: 35.116, lng: 135.768},
      zoom: 10
    });
    let geo_loc={
      //我住的地方
      lat: 35.31940,
      lng: 135.748047
    };
    let marker1= new google.maps.Marker({
      position: geo_loc,
      map: map
    });
  };
  $.ajax({
    type:"GET",
    url:"https://developers.google.com/places/web-service/place-id?hl=en_US#find-id"
  }).done(function(data){
    // datastring=JSON.stringify(data);
    // dataparse=JSON.parse(data);
    // console.log(datastring);
    // console.log(dataparse);
  }).fail(function(error){
    console.log(error);
  })
});