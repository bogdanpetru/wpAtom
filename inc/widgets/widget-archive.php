<?php 

/**
 * Widget Archive 
 * 
 * To be used with loop-dynamic.
 * It creates a list of links with year/month query vars.
 */
class Box_Archive_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'box-archive', // Base ID
			__( 'Arhiva Dimanica', 'simpleWidget' ), // Name
			array( 'description' => __( '', 'simpleWidget' ), ) // Args
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

        // if is not archive don't show the widget
        if( !is_archive() ){
        	return;
        }
	
		$date = $wp_query->query_vars['data'];
		$post_type = $wp_query->query['post_type'];
		$actual_link = strtok($_SERVER["REQUEST_URI"],'?');

		$lunile_anului = array(
			"ianuarie",
			"februarie",
			"martie",
			"aprilie",
			"mai",
			"iunie",
			"iulie",
			"august",
			"septembrie",
			"octombrie",
			"noiembrie",
			"decembrie",
		);

		// The Query
		$args = array(
			'post_type' => 'post',
			'posts_per_page'=>-1,
			);

		// Add category
		global $wp_query;
		$category_name = isset($wp_query->query['category_name']) ? $wp_query->query['category_name'] : false;

		if( (bool) $category_name ){
			$args['category_name'] = $category_name;
		}

		$the_query = new WP_Query( $args );

		$years = array();
		// The Loop
		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$year = get_the_date("Y");
				$month = get_the_date("n");
			
				if( !isset( $years[$year] ) ){
					$years[$year] = array();
				}
				if( !isset( $years[$year][$month] ) ){
					$years[$year][$month] = $month;		
				}
			}
		}
		/* Restore original Post Data */
		wp_reset_postdata();

		// sort array

		$widget_html =  "<div class='widget archive'>";
		$widget_html .=  "<ul>";
		$i = 0;

		foreach($years as $year => $months ){

			// Sort months
			sort($months);
			
			if( $i == 0 ){
				$widget_html .=  "<li class='active'>";
			} else {
				$widget_html .=  "<li>";
			}

			$widget_html .=  "<a class='year' href=''>$year</a>";
			$widget_html .=  "<ul>";

			foreach($months as $month){
				$month_name = ucfirst($lunile_anului[$month - 1]); // 0 index
				$widget_html .=  "<li> <a href='{$actual_link}?an=$year&luna=$month'>$month_name</a></li>";
			}
			$widget_html .=  "</ul>";
			$widget_html .=  "</li>";

			// increment to know if is first
			$i++;
		}
		$widget_html .=  "</ul>";
		$widget_html .=  "</div>";

		echo $widget_html;

	}	

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$facebook = ! empty( $instance['facebook'] ) ? $instance['facebook'] : __( '', 'adrc' );
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
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? $new_instance['facebook'] : '';

		return $instance;
	}


} 

// register box_social widget
function register_box_archive() {
    register_widget( 'Box_Archive_Widget' );
}
add_action( 'widgets_init', 'register_box_archive' );


?>