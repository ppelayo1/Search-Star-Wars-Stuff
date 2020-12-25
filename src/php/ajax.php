<?php
    //handle ajax calls for the Hint, opens the json file and returns a list of all names
    function starWarsAjaxHint() {
        //need to include the constants
        //local variables
        global $starWarsConstants;
        $search_term = stripslashes($_GET['search_term']);
        $url =  plugin_dir_url(dirname(__FILE__)) . 'json/' . $starWarsConstants['FILENAME'];
        $dataSet = null;
        $names = []; //array to hold all the names found in dataSet
        $regex = "/" . $search_term . ".+|.+" . $search_term . ".+|.+" . $search_term . "/i" ; //checks if the input is present in the begining, middle, or end of the strings
        $returnArray = [];
        $tempArray = [];
        
        
        
        //open the file
        $dataSet = json_decode(file_get_contents($url));
        
        //build an array of only the names
        foreach($dataSet as $element){
            array_push($names,$element->name);
        }
        //match with regex and return the names that match
        $tempArray = preg_grep($regex,$names);
        
        //takes only the values to return, ensures an array is returned and not an object
        foreach($tempArray as $element){
            array_push($returnArray,$element);
        }
        
        //return the results to javascript client
        echo json_encode($returnArray);
        
        wp_die();
    }

    //handles the ajax submit
    function starWarsAjaxSubmit() {
        //need to include the constants
        //local variables
        global $starWarsConstants;
        $url =  plugin_dir_url(dirname(__FILE__)) . 'json/' . $starWarsConstants['FILENAME'];
        $search_term = stripslashes($_GET['search_term']);
        $outputElement = null;
        $dataSet = null;
        $matchFound = false;
        $size = null;
        
        //open the file
        $dataSet = json_decode(file_get_contents($url));
        
        //get dataSet size
        $size = count($dataSet);
        
        //find the searched item, if it exists, get its element, and set the flag
        for($i = 0; $i < $size && !$matchFound;$i++){
            
            if(!strcasecmp($dataSet[$i]->name,$search_term)){
                $outputElement = $i;
                $matchFound = true;
               
            }
            
        }
        
        //return the matched object
        echo json_encode($dataSet[$outputElement]);
        
        wp_die();
    }
?>