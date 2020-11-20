<?php
    //handle ajax calls for the Hint
    function starWarsAjaxHint() {
        //need to include the constants
        global $starWarsConstants;
        global $wpdb;
        $search_term = $_GET['search_term'] . '%';
        $output = [];
        
        //array of tables
        $tabArray = $starWarsConstants['TABLENAMES'];
        
        //only perform a query if input is in the search_term
        if(strcmp($search_term, '%')){
            foreach($tabArray as $table){
                $tableName = $wpdb->prefix .$table;
                $sql = "SELECT name FROM $tableName WHERE name LIKE %s";
                $sql = $wpdb->prepare($sql,$search_term);
                $sql = $wpdb->get_results($sql);
                $output = array_merge($sql,$output);
            }
        }
        echo json_encode($output);
        
        wp_die();
    }

    //handles the ajax submit
    function starWarsAjaxSubmit() {
        //need to include the constants
        global $starWarsConstants;
        global $wpdb;
        $search_term = $_GET['search_term'];
        $output = [];
        
        //array of tables
        $tabArray = $starWarsConstants['TABLENAMES'];
        
        //only perform a query if input is in the search_term
        if(strcmp($search_term, ' ')){
            foreach($tabArray as $table){
                $tableName = $wpdb->prefix .$table;
                $sql = "SELECT * FROM $tableName WHERE name = %s";
                $sql = $wpdb->prepare($sql,$search_term);
                $sql = $wpdb->get_results($sql);
                $output = array_merge($sql,$output);
            }
        }
        echo json_encode($output);
        
        wp_die();
    }
?>