<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


/**
 * Custom
 */

function enqueue_scripts() {
	wp_enqueue_script( 'custom-utils', '/wp-content/themes/astra-child/assets/js/unminified/utils.js', array(), filemtime( get_theme_file_path( 'assets/js/unminified/utils.js' ) ), true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

require_once get_stylesheet_directory() . '/inc/fetch-handler.php';


function custom_header_code() {
	echo "<script>const adminAjax = '" . esc_url( admin_url( 'admin-ajax.php' ) ) . "'</script>";
}
add_action ( 'wp_head', 'custom_header_code' );