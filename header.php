<?php 
/**
 * @package simpleTheme
 */
global $simpleTheme;

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php wp_head(); ?>

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:600,400,300,300italic,700,700italic,900' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- Styles -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/assets/js/lib/slick/slick.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/assets/js/lib/magnific/magnific.css">
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/assets/css/main.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Google Maps -->
	<script src="http://maps.gstatic.com/maps-api-v3/api/js/19/9/main.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

</head>

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
				<h1>
					<img src="<?php bloginfo('stylesheet_directory') ?>/assets/img/logo.jpg">
				</h1>
			</div>
		</div>

		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

		<div class="search-form">
			<?php get_search_form(); ?>
		</div>
		<!-- .search-form -->

	</header>


	<div id="content" class="container">
	