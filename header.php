<?php 
/**
 * @package WordPress
 * @subpackage wpAtom
 * @author: Bogdan Petru Pintican
 */
global $wpAtom;

get_template_part('templates/head');
?>

<?php 
	$is_not_home_page = !(is_front_page() || is_home()) ? 'not-home' : '';
 ?>
<body <?php body_class($is_not_home_page); ?>>

	<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

	<header id="header" class="container">
		
		<div class="row">
			<div class="logo col-sm-3">
        <h1> <a href="<?php bloginfo('url') ?>">Logo</a> </h1>
			</div>
		</div>

		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

		<div class="search-form">
			<?php get_search_form(); ?>
		</div>
		<!-- .search-form -->

	</header>

	