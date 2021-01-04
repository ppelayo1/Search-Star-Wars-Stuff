<?php
/**
 * Plugin Name: Search Star Wars Stuff
 * Plugin URI: 
 * Description: Enter a Star Wars character and find their attributes.
 * Author: PatrickPelayo
 * Author URI: https://www.PatrickP.Tech/
 * Version: 1.1.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * 
 */
 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';