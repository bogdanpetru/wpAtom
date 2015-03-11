<?php 

/**
 * Adds Box-1 widget.
 */
class box_col extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'box-2', // Base ID
			__( 'Caseta Dubla', 'adrc' ), // Name
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

        if( $tip_caseta == 'red' ){
        	$img_box_class = 'col-sm-4';
        	$text_box_class = 'col-sm-8';
        } else {
        	$img_box_class = 'col-sm-5';
        	$text_box_class = 'col-sm-7';
        }


	?>

	<?php if( $id == 'home-sidebar-3' ): ?>
	<div class="col-sm-12">
	<?php endif; ?>
		<div class="widget box-col <?= $tip_caseta ?>">
			<span class="row">
				<span class="img-box <?= $img_box_class ?>">
					<img src="<?= $url_img ?>">
					<span class="text">
						<?= $text_caseta ?>
					</span>
				</span>
				
				<span class="text-box <?= $text_box_class ?>">
					<?= $content ?>
				</span>
			</span>
		</div>
		<!-- .widget -->
	<?php if( $id == 'home-sidebar-3' ): ?>
	</div>	
	<?php endif; ?>


	<?php

	}	

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$url_imagine = ! empty( $instance['url_img'] ) ? $instance['url_img'] : __( 'Adaugati Url-ul Imaginii', 'adrc' );
		$text_caseta = ! empty( $instance['text_caseta'] ) ? $instance['text_caseta'] : __( 'Text Caseta', 'adrc' );
		$tip_caseta = ! empty( $instance['tip_caseta'] ) ? $instance['tip_caseta'] : __( 'albastru-2', 'adrc' );
		$content = ! empty( $instance['content'] ) ? $instance['content'] : __( 'Hello World', 'adrc' );

		?>
		
		<div class="widget-caseta">

				<p>
					<label for="<?php echo $this->get_field_id( 'url_img' ); ?>"><?php _e( 'Url Imagine:' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'url_img' ); ?>" name="<?php echo $this->get_field_name( 'url_img' ); ?>" type="text" value="<?php echo esc_attr( $url_imagine ); ?>">
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'text_caseta' ); ?>"><?php _e( 'Text Caseta:' ); ?></label> 
					<textarea class="widefat" id="<?php echo $this->get_field_id( 'text_caseta' ); ?>" name="<?php echo $this->get_field_name( 'text_caseta' ); ?>"><?php echo esc_attr( $text_caseta ); ?></textarea>
				</p>

				<p>
					<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Selectati tip caseta:' ); ?></label>
					
					<select data-type='<?= $tip_caseta ?>' name="<?php echo $this->get_field_name( 'tip_caseta' ); ?>" id="<?php echo $this->get_field_id( 'tip_caseta' ); ?>">
						<option value="red">Rosu</option>
						<option value="grey">Gri</option>
					</select>
				</p>
				
				<?php 

			    $rand    = rand( 0, 999 );
			    $ed_id   = $this->get_field_id( 'wp_editor_' . $rand );
			    $ed_name = $this->get_field_name( 'wp_editor_' . $rand );

			    $editor_id = $ed_id;

			      $settings = array(
			      'media_buttons' => false,
			      'textarea_rows' => 3,
			      'textarea_name' => $ed_name,
			      'teeny'         => true,
			    );

			    wp_editor( $content, $editor_id, $settings );

					printf(
					  '<input type="hidden" id="%s" name="%s" value="%d" />',
					  $this->get_field_id( 'the_random_number' ),
					  $this->get_field_name( 'the_random_number' ),
					  $rand
					);

				 ?>



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
		$instance['tip_caseta'] = ( ! empty( $new_instance['tip_caseta'] ) ) ? $new_instance['tip_caseta'] : '';
		$instance['text_caseta'] = ( ! empty( $new_instance['text_caseta'] ) ) ? $new_instance['text_caseta']  : '';
		$instance['url_img'] = ( ! empty( $new_instance['url_img'] ) ) ? $new_instance['url_img']  : '';

		$rand = (int) $new_instance['the_random_number'];
		$instance['content'] = $new_instance[ 'wp_editor_' . $rand ];

		return $instance;
	}




} // class box_col


// register box_col widget
function register_box_col() {
    register_widget( 'box_col' );
}
add_action( 'widgets_init', 'register_box_col' );


?>
