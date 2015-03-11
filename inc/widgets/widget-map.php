<?php 

/**
 * Adds Box-1 widget.
 */
class Box_Map_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'box-social', // Base ID
			__( 'Caseta cu Harta', 'adrc' ), // Name
			array( 'description' => __( '', 'adrc' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

    	if( $id !== 'home-sidebar-3' ):
			$this->simple_widget();
		else:
			echo '<div class="col-sm-6">';
				$this->simple_widget();
			echo '</div>';
		endif;

	}	

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		?>
		<div class="widget-caseta">
			<p></p>	
		</div>
		<?php 


	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		//$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? $new_instance['facebook'] : '';
		//$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? $new_instance['youtube'] : '';

		return $instance;
	}

	public function simple_widget(){
		global $adrc_theme;
		?>
		<div class="map-wrapper">
			<div id="gmap"></div>
			<h2 class="overlay">
				LOCALIZARE ADR CENTRU
			</h2>
		</div>
	
		<script>
			jQuery(document).on('ready', function(){
				var address = 'Strada Decebal Alba Iulia 510093';
				var lagLngObject = '46.070942,23.578414';

				   var map = new google.maps.Map(document.getElementById('gmap'), { 
					   mapTypeId: google.maps.MapTypeId.ROADMAP,
					   zoom: 15,
					   disableDefaultUI: true
				   });

				   var geocoder = new google.maps.Geocoder();

				   geocoder.geocode({
					  'address': address
				   }, 
				   function(results, status) {
					  if(status == google.maps.GeocoderStatus.OK) {
						 new google.maps.Marker({
							position: results[0].geometry.location,
							map: map
						 });
						 map.setCenter(results[0].geometry.location);
					  }
					  else {
						 // Google couldn't geocode this request. Handle appropriately.
					  }
				   });
			});
		</script>
		<?php 
	}


} // class box_social


// register box_social widget
function register_box_map() {
    register_widget( 'Box_Map_Widget' );
}
add_action( 'widgets_init', 'register_box_map' );


?>