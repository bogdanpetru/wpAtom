import $ from 'jQuery';
// import google from 'google-maps';


let mapCanvas = document.getElementById('map-canvas');
let $mapCanvas = $(mapCanvas);
let adress = $mapCanvas.data('adress');
let mapOptions = { zoom: 16 }
let geocoder = new google.maps.Geocoder();


function init(){
  geocoder.geocode({
    address: adress
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      center = results[0].geometry.location;
      initializeMap(center);
    } else {
      console.log("Geocode was not successful for the following reason: " + status);
    }
  });
}

function initializeMap(center){

  mapOptions.center = center;
  let map = new google.maps.Map( mapCanvas, mapOptions);

  let marker = new MarkerWithLabel({
      position: center,
      map: map,
      labelContent: "58 rue César Geoffray",
      labelAnchor: new google.maps.Point(22, 0),
      labelClass: "labels",
  });

  marker.setMap(map);
}

export default init;