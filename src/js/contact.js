import $ from 'jQuery';
import google from 'google-maps';

console.log(google);

var mapCanvas = document.getElementById('map-canvas');
var $mapCanvas = $(mapCanvas);
var adress = $mapCanvas.data('adress');

// var  mapOptions = { zoom: 16 }

// var geocoder = new google.maps.Geocoder();
// var map;
// var marker;
// var center;


// geocoder.geocode({
//   address: adress
// }, function(results, status) {
//   if (status == google.maps.GeocoderStatus.OK) {
//     center = results[0].geometry.location;
//     initializeMap();
//   } else {
//     console.log("Geocode was not successful for the following reason: " + status);
//   }
// });


function initializeMap(){

mapOptions.center = center;
map = new google.maps.Map( mapCanvas, mapOptions);

// Marker
marker = new MarkerWithLabel({
  position: center,
  map: map,
  labelContent: "58 rue César Geoffray",
  labelAnchor: new google.maps.Point(22, 0),
  labelClass: "labels",
});
marker.setMap(map);
}


export function contactMap(){
  return 'hello world';
}