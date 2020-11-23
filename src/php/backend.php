<?php
    //initialize the table controller   
    global $patrickP_StarWars_TableController;
    $patrickP_StarWars_TableController = new PatrickP_StarWars_TableController();
    
    //build the tables and insert the data
    function buildInsert(){
        global $patrickP_StarWars_TableController;
        
        //check if tables are already built, if not then build them
        if(!$patrickP_StarWars_TableController->chkTablesExist()){
            $patrickP_StarWars_TableController->buildAllTables();
            $patrickP_StarWars_TableController->insertData();
        }
        
    }
    
?>