<?php
    //handle ajax calls for the Hint, opens the json file and returns a list of all names
    function starWarsAjaxHint() {
        //need to include the constants
        //local variables
        global $starWarsConstants;
        $url =  plugin_dir_url(dirname(__FILE__)) . 'json/' . $starWarsConstants['FILENAME'];
        $dataSet = null;
        $names = []; //array to hold all the names found in dataSet
        //open the file
        $dataSet = json_decode(file_get_contents($url));
        
        foreach($dataSet as $element){
            array_push($names,$element->name);
        }
        
        echo json_encode($names);
        
        wp_die();
    }

    //handles the ajax submit
    function starWarsAjaxSubmit() {
        //need to include the constants
        global $starWarsConstants;
        global $wpdb;
        $search_term = stripslashes($_GET['search_term']);
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