<?php 

/**
 * Adds Box-1 widget.
 */
class box_accordion extends WP_Widget {

	public $n_items = 5;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'box-accordion', // Base ID
			__( 'Caseta Accordion', 'adrc' ), // Name
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

		$hasWrapper = false;
		$i = 1;
		$n_items = $this->n_items;


    	if( $id == 'home-sidebar-3' ):
    		$hasWrapper = true;
    	endif;

	?>

	<div class='<?= $hasWrapper ? 'col-sm-6' : 'col-xs-12' ?>'>

			<div class="widget box-accordion">	
				<h2 class="box-title"><img src="<?php bloginfo( 'template_url' ); ?>/assets/img/icon-list-small.png">PROIECTE FINALIZATE</h2>
		
			<?php 
				$bfi_args = array( 'width'=> 166, 'height'=>69 );

				while( $i <= $n_items ){

					$img = $instance["url_img_$i"];
					$img = bfi_thumb( $img, $bfi_args );

					$text = $instance["text_$i"] . " <a href='{$instance["url_$i"]}'>{$instance["url_text_$i"]}</a> <span class='arrow-small'>&#8250;</span>";
					$first = $i == 1;

					$this->get_item($i, $img, $text, $first);
					$i++;
				}
			 ?>

			</div>
			<!-- .box-accordion -->

	</div>

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

		$i = 1;
		$n_items = $this->n_items;
		?>
		
		<div class="widget-caseta">
			<?php 

				while( $i <= $n_items ){
					$url_img = ! empty( $instance["url_img_$i"] ) ? $instance["url_img_$i"] : __( 'Url Imagine', 'adrc' );
					$text = ! empty( $instance["text_$i"] ) ? $instance["text_$i"] : __( 'Text', 'adrc' );
					$url_img = ! empty( $instance["url_img_$i"] ) ? $instance["url_img_$i"] : __( 'Url Imagine', 'adrc' );
					$url_text = ! empty( $instance["url_text_$i"] ) ? $instance["url_text_$i"] : __( 'Vezi proiecte', 'adrc' );
					$url = ! empty( $instance["url_$i"] ) ? $instance["url_$i"] : __( 'Url', 'adrc' );

					$this->get_input($i, $url_img, $text, $url_text, $url);
					$i++;
				}

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

		var_dump($old_instance);


		$instance = array();

		// Save array vals
		$i = 1;
		$n_items = $this->n_items;
		
			while( $i <= $n_items ){
				$instance["url_img_$i"] = ( ! empty( $new_instance["url_img_$i"] ) ) ? $new_instance["url_img_$i"] : '';
				$instance["text_$i"] = ( ! empty( $new_instance["text_$i"] ) ) ? $new_instance["text_$i"] : '';
				$instance["url_text_$i"] = ( ! empty( $new_instance["url_text_$i"] ) ) ? $new_instance["url_text_$i"] : '';
				$instance["url_$i"] = ( ! empty( $new_instance["url_$i"] ) ) ? $new_instance["url_$i"] : '';
				$i++;
			}
		
		print_r($instance);

		return $instance;
	}


	public function get_item($i, $img, $text, $first){
		?>
			<div class="accordion-item <?= $first ? 'expand' : ''; ?>">	
				<h3 class="toggle-button">Proiect POR pe Axa <?= $i ?> <i class="fa fa-chevron-up"></i><i class="fa fa-chevron-down"></i></h3>
				<div class="text-box">	
					<img src="<?= $img ?>">
					<span class="text">	
						<?= $text ?>
					</span>
				</div>
				<!-- .text-box -->
			</div>
			<!-- .accordion-item -->
		<?php
	}

	public function get_input($i, $url_img, $text, $url_text, $url ){
		?>
			<h2>Linie <?= $i ?></h2>
			<p>
				<label for="<?php echo $this->get_field_id( "url_img_$i" ); ?>"><?php _e( 'Url Imagine:' . $i ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( "url_img_$i" ); ?>" name="<?php echo $this->get_field_name( "url_img_$i" ); ?>" value="<?= $url_img ?>" type="text">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( "text_$i" ); ?>"><?php _e( 'Text:'  . $i ); ?></label> 
				<textarea class="widefat" id="<?php echo $this->get_field_id( "text_$i" ); ?>" name="<?php echo $this->get_field_name( "text_$i" ); ?>"><?= $text ?></textarea>
				<label for="<?php echo $this->get_field_id( "url_text_$i" ); ?>"><?php _e( 'Text Url:'  . $i ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( "url_text_$i" ); ?>" name="<?php echo $this->get_field_name( "url_text_$i" ); ?>" value="<?= $url_text ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( "url_$i" ); ?>"><?php _e( 'Url:'  . $i ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( "url_$i" ); ?>" name="<?php echo $this->get_field_name( "url_$i" ); ?>" value="<?= $url ?>">
			</p>
		<?php
	}

} // class box_accordion


// register box_accordion widget
function register_box_accordion() {
    register_widget( 'box_accordion' );
}
add_action( 'widgets_init', 'register_box_accordion' );


?>
