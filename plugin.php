<?php
/**
 * Plugin Name: star wars
 */
 
 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';

//activation and deactivation hooks
register_activation_hook( __FILE__, "setUp" );
register_activation_hook( __FILE__, "buildInsert" );
register_deactivation_hook( __FILE__, 'setUp' );
register_deactivation_hook( __FILE__, 'dropTables' );

//widgit initialization hook
add_action( 'widgets_init', 'register_star_wars_widget' );

//Ajax handler functions
add_action( 'wp_ajax_patrickp_star_wars_query_hint', 'starWarsAjaxHint');
add_action( 'wp_ajax_patrickp_star_wars_query_submit', 'starWarsAjaxSubmit');

?>