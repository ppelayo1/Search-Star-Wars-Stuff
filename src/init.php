<?php
    function setUp(){
        include plugin_dir_path( __FILE__ ) . 'php/constants.php';
        include plugin_dir_path( __FILE__ ) . 'php/classes.php';
        include plugin_dir_path( __FILE__ ) . 'php/backend.php';
    }

    function register_star_wars_widget() {
        include plugin_dir_path( __FILE__ ) . 'php/constants.php';
        include plugin_dir_path( __FILE__ ) . 'php/widget.php';
        include plugin_dir_path( __FILE__ ) . 'php/ajax.php';
        register_widget( 'PatrickP_Star_Wars_Widget' );
        add_action('wp_enqueue_scripts','scriptsStyles');
    }

    function scriptsStyles(){
        //The js script and its style for the widget on the front end
        wp_enqueue_script ( 'starWarsConstantsjs', plugin_dir_url( __FILE__ ) . 'js/constants.js');
        wp_enqueue_script ( 'starWarsWidgetjs', plugin_dir_url( __FILE__ ) . 'js/widget.js',array('jquery'),false,true);
        
        //localize the script for ajax call
        wp_localize_script( 'starWarsWidgetjs', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
    }
?>