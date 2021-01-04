<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//regular wdiget stuff
//widgit initialization hook
add_action( 'widgets_init', 'register_star_wars_widget' );

//Ajax handler functions
add_action( 'wp_ajax_patrickp_star_wars_query_hint', 'starWarsAjaxHint');
add_action( 'wp_ajax_patrickp_star_wars_query_submit', 'starWarsAjaxSubmit');
add_action( 'wp_ajax_nopriv_patrickp_star_wars_query_hint', 'starWarsAjaxHint' );
add_action( 'wp_ajax_nopriv_patrickp_star_wars_query_submit', 'starWarsAjaxSubmit' );

    //enque and register the scripts and styles for the widget
    function register_star_wars_widget() {
        include plugin_dir_path( __FILE__ ) . 'assets/php/constants.php';
        include plugin_dir_path( __FILE__ ) . 'assets/php/widget.php';
        include plugin_dir_path( __FILE__ ) . 'assets/php/ajax.php';
        register_widget( 'PatrickP_Star_Wars_Widget' );
    }

    

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function search_star_wars_cgb_block_assets() { // phpcs:ignore
    //this is needed for the widget and the gutenberg blocks
    function scriptsStyles(){
        //array of libraries needed for the starWarWidget
        $dependencies = ['jquery','jquery-ui-autocomplete'];
        
        //The js scripts and its style for the widget on the front end
        wp_enqueue_script ( 'starWarsConstantsjs', plugin_dir_url( __FILE__ ) . 'assets/js/constants.js');
        wp_enqueue_script ( 'starWarsWidgetjs', plugin_dir_url( __FILE__ ) . 'assets/js/widget.js',$dependencies,false,true);
        wp_enqueue_style ('starWarsFont',"https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Merriweather+Sans:wght@300&display=swap");//Merriweather Sans font
        wp_enqueue_style ( 'jqueryUIcssStarWars', plugin_dir_url( __FILE__ ) . 'assets/css/jqueryAutoComplete.css'); //take from jquery ui css theme builder
        wp_enqueue_style ( 'starWarsWidgetCSS', plugin_dir_url( __FILE__ ) . 'assets/css/widget.css');
        
        
        //localize the script for ajax call
        wp_localize_script( 'starWarsWidgetjs', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
    }
    
    scriptsStyles();
    
    
	// Register block styles for both frontend + backend.
	wp_register_style(
		'search_star_wars-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);

	// Register block editor script for backend.
	wp_register_script(
		'search_star_wars-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_register_style(
		'search_star_wars-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'search_star_wars-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'cgb/block-search-star-wars', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'search_star_wars-cgb-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'search_star_wars-cgb-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'search_star_wars-cgb-block-editor-css',
		)
	);
}

// Hook: Block assets.
add_action( 'init', 'search_star_wars_cgb_block_assets' );
