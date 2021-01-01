<?php
    function register_star_wars_widget() {
        include plugin_dir_path( __FILE__ ) . 'php/constants.php';
        include plugin_dir_path( __FILE__ ) . 'php/widget.php';
        include plugin_dir_path( __FILE__ ) . 'php/ajax.php';
        register_widget( 'PatrickP_Star_Wars_Widget' );
        add_action('wp_enqueue_scripts','scriptsStyles');
    }

    function scriptsStyles(){
        //array of libraries needed for the starWarWidget
        $dependencies = ['jquery','jquery-ui-autocomplete'];
        
        //The js scripts and its style for the widget on the front end
        wp_enqueue_script ( 'starWarsConstantsjs', plugin_dir_url( __FILE__ ) . 'js/constants.js');
        wp_enqueue_script ( 'starWarsWidgetjs', plugin_dir_url( __FILE__ ) . 'js/widget.js',$dependencies,false,true);
        wp_enqueue_style ('starWarsFont',"https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:wght@400;700&family=Luckiest+Guy&display=swap");//luckiest guy + libre caslon 400 && 700
        
        wp_enqueue_style ( 'jqueryUIcssStarWars', plugin_dir_url( __FILE__ ) . 'css/jqueryAutoComplete.css'); //take from jquery ui css theme builder
        wp_enqueue_style ( 'starWarsWidgetCSS', plugin_dir_url( __FILE__ ) . 'css/widget.css');
        
        
        //localize the script for ajax call
        wp_localize_script( 'starWarsWidgetjs', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
    }
?>