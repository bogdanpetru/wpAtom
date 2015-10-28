import $ from 'jQuery';
import GoogleMapsLoader from 'google-maps';


var contactMap = {

  init: () => {
    GoogleMapsLoader.load(contactMap.start);
  },

  start: (google) => {    
    let mapCanvas = document.getElementById('map-canvas');
    let $mapCanvas = $(mapCanvas);
    let adress = $mapCanvas.data('adress') || 'Cluj-Napoca, Romania';
    let mapOptions = { zoom: 16 }
    let geocoder = new google.maps.Geocoder();
    let map = new google.maps.Map( mapCanvas, mapOptions);

    contactMap.map = map;
  
    geocoder.geocode({
      address: adress
    }, (results, status) => {
      if (status == google.maps.GeocoderStatus.OK) {
        let coord = results[0].geometry.location;
        
        map.setCenter(coord);
      } else {
        console.log("Geocode was not successful for the following reason: " + status);
      }
    });

  },
};




export default contactMap;