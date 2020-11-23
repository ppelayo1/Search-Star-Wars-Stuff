<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
    
        
//drop the tables
function dropTables(){
    include plugin_dir_path( __FILE__ ) . '/src/php/constants.php';
    include plugin_dir_path( __FILE__ ) . '/src/php/classes.php';
    
    $patrickP_StarWars_TableController = new PatrickP_StarWars_TableController();
    $patrickP_StarWars_TableController->removeAllTables();
}

?>