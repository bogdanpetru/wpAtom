"use strinct";

var app = (function($){
	
	return {

		init: function(){

			// Initialize submenu fix

		},

		load: function(){
			
			// Page Slider
			// this.pageSlider();
		},

		resize: function(){
			this.updateProps();			
		},

		prop : {
			windowWidth : false
		},

		// jQuery objects
		$window: $(window),
		$document: $(document),

		// Utils
		updateProps: function(){
			this.prop.windowWidth = $(window).outerWidth();
		},

		// Components

		contactMap: function(){

			var	mapCanvas = document.getElementById('map-canvas'), 
				$mapCanvas = $(mapCanvas),
				adress = $mapCanvas.data('adress'),

				mapOptions = {
					// center: { lat: lat, lng: lng },
					zoom: 16
				},
				geocoder = new google.maps.Geocoder(),
				map,
				marker,
				center;


				if( !mapCanvas ){
					return;	
				}
			
				geocoder.geocode({
					address: adress
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						center = results[0].geometry.location;
						initializeMap();
					} else {
						console.log("Geocode was not successful for the following reason: " + status);
					}
				});


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


		},
		
		newsSlider: function(){
			$('.news-slider ul').slick({
				slidesToShow: 1,
				arrows: false,
				dots: true,
				responsive:[
					{
						breakpoint: 768,
						settings:{
							dots: false
						}
					}
				]
			});
		},



	};
	
})(jQuery);



jQuery(document).ready(function($){
	app.init();
});

jQuery(window).load(function($){
	app.load();
});

jQuery(window).on('resize', function(){
	app.resize();
});