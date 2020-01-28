$(function(){
  var map;
  var service;
  var infowindow;
  function initMap() {
    infowindow = new google.maps.Infowindow();
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
  // $.ajax({
  //   type:"GET",
  //   dataType:'jsonp',
  //   // 為了crossdomain request
  //   crossDomain:'true',
  //   url:"https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&types=food&name=harbour&key=AIzaSyA1_8F9VSj4orU5N-_A-7Pb_y6BU0ajHso",
  // }).done(function(data){
  //   console.log(JSON.parse(data));
  //   // datastring=JSON.stringify(data);
  //   // dataparse=JSON.parse(data);
  //   // console.log(datastring);
  //   // console.log(dataparse);
  // }).fail(function(error){
  //   console.log(error);
  // })
});