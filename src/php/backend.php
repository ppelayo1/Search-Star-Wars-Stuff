<?php
    //initialize the table controller   
    global $patrickP_StarWars_TableController;
    $patrickP_StarWars_TableController = new PatrickP_StarWars_TableController();
    
    //build the tables and insert the data
    function buildInsert(){
        global $patrickP_StarWars_TableController;
        
        $patrickP_StarWars_TableController->buildAllTables();
        $patrickP_StarWars_TableController->insertData();
        
    }
    //drop the tables
    function dropTables(){
        global $patrickP_StarWars_TableController;
        $patrickP_StarWars_TableController->removeAllTables();
    }
?>