console.log($.cookie());
console.log($.cookie('latitude'));
let latitude = parseFloat($.cookie('latitude'));
console.log(latitude);
console.log($.cookie('longitude'));
let longitude = parseFloat($.cookie('longitude'));
console.log(longitude);
// console.log(document.cookie);
var map;
function initMap() {
  geo_loc = {
    lat: latitude,
    lng: longitude
  };
  map = new google.maps.Map(document.getElementById('map'), {
    center: geo_loc,
    zoom: 15,
    scaleControl:true
  });
  
  let marker1= new google.maps.Marker({
    position:geo_loc,
    map:map
  });
}
// $(function(){
//   console.log($.cookie());
//   console.log($.cookie('latitude'));
//   let latitude = parseFloat($.cookie('latitude'));
//   console.log(latitude);
//   console.log($.cookie('longitude'));
//   let longitude = parseFloat($.cookie('longitude'));
//   console.log(longitude);
//   // console.log(document.cookie);
//   var map;
//   function initMap() {

//     geo_loc = {
//       lat: latitude,
//       lng: longitude
//     };
//     map = new google.maps.Map(document.getElementById('map'), {
//       // center: geo_loc,
//       center: {
//         lat: 85.0142299,
//         lng: 135.748218
//       },
//       zoom: 18,
//       scaleControl:true
//     });
    
//     let marker1= new google.maps.Marker({
//       position:geo_loc,
//       map:map
//     });

    // map = new google.maps.Map(document.getElementById('map'), {
    //   center: {lat: 35.116, lng: 135.768},
    //   zoom: 10
    // });
    // let geo_loc={
    //   lat: 35.31940,
    //   lng: 135.748047
    // };
    // let marker1= new google.maps.Marker({
    //   position: geo_loc,
    //   map: map
    // });
//   };
// });