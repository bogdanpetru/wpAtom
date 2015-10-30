<?php
/**
 * WooCommerce Custom Functions
 *
 * @package WordPress
 * @subpackage wpAtom
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/*	Initiate WooCommerce
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'woocommerce' );


/*-----------------------------------------------------------------------------------*/
/*	WooCommerce Shop Title
/*-----------------------------------------------------------------------------------*/

add_filter( 'woocommerce_page_title', 'woo_shop_page_title');

function woo_shop_page_title( $page_title ) {

    if( 'Shop' == $page_title) {
        return "";
    } else {
    	return $page_title;
    }
}

?>