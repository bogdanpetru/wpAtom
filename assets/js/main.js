"use strinct";

var app = (function($){
	
	var app = {

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

		updateProps: function(){
			this.prop.windowWidth = $(window).outerWidth();
		},

	return app;
	
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