(function($){

	// Select image
	$(document).ready(function(){
	    if ($('.set_custom_images').length > 0) {
	    if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
	        $('.wrap').on('click', '.set_custom_images', function(e) {
	            e.preventDefault();

	            var button = $(this);
	            var id = button.prev();
	            
	            wp.media.editor.send.attachment = function(props, attachment) {
	                id.val(attachment.id);
	            };
	            
	            wp.media.editor.open(button);
	            return false;
	        });
	    }
	};


		// Select
	    // $( '.widget-control-save' ).on('click', function(){
     //       setTimeout( function(){
     //        updateOption();
     //       }, 1000);
     //    });

        updateOption();

        $(document).on('ajaxStop', function(){
            updateOption();
        });

        function updateOption(){

            var $select = $('.widget-caseta select');

                $select.each(function(i, el){
                    var $el = $(el),
                        val = $el.data('value');

                    $el.find("option").each(function(index, el){
                        if($(el).val() === val){
                          el.selected = true;
                        }  
                    });
            
                });
        }


	});

})(jQuery);