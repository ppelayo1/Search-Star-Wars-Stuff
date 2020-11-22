<?php
//this abstract class holds the sql table names and urls to the data at star wars api
abstract class PatrickP_StarWars_AbstractParent{
    
    //these members hold the sql call strings to create the tables
    protected $personsTab;
    protected $planetsTab;
    protected $star_shipsTab;
    protected $speciesTab;
    protected $filmsTab;
    protected $vehiclesTab;
        
    public function __construct(){
        //initialize the local variables for the tables
        $this->initVaraibles();
    }
    
    //initializes the local variables
    private function initVaraibles(){
        global $starWarsConstants; //needed to be global to access the constant
        
        //these are the names of the tables
        $this->personsTab = $starWarsConstants['TABLENAMES']['PERSONS_TAB'];
        $this->planetsTab = $starWarsConstants['TABLENAMES']['PLANETS_TAB'];
        $this->star_shipsTab = $starWarsConstants['TABLENAMES']['STAR_SHIPS_TAB'];
        $this->speciesTab = $starWarsConstants['TABLENAMES']['SPECIES_TAB'];
        $this->filmsTab = $starWarsConstants['TABLENAMES']['FILMS_TAB'];
        $this->vehiclesTab = $starWarsConstants['TABLENAMES']['VEHICLES_TAB'];
    }
}

//this class's purpose is to add the tables to the database
class PatrickP_StarWars_CreateTables extends PatrickP_StarWars_AbstractParent{
    //these members will hold the sql strings for the sql calls in creating the tables
    protected $personSQL;
    protected $planetSQL;
    protected $star_shipsSQL;
    protected $speciesSQL;
    protected $filmsSQL;
    protected $vehiclesSQL;
    
    public function __construct(){
        parent::__construct();
        
        //initialize the local variables for the tables
        $this->initVaraibles();
    }
    
    //initializes the local variables
    private function initVaraibles(){
        //create collate first
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        
        //build the strings for the sql calls that create the tables
        //function will need to replace table_name with the actual table name
        $this->personSQL = "CREATE TABLE table_name (
          id mediumint NOT NULL AUTO_INCREMENT,
          name tinytext NOT NULL,
          height tinytext DEFAULT 'N/A',
          mass tinytext DEFAULT 'N/A',
          birth_year tinytext DEFAULT 'N/A',
          gender tinytext DEFAULT 'N/A',
          homeworld tinytext DEFAULT 'N/A',
          PRIMARY KEY  (id)
        ) $charset_collate;";
        
        $this->planetSQL = "CREATE TABLE table_name (
          id mediumint NOT NULL AUTO_INCREMENT,
          name tinytext NOT NULL,
          rotation_period tinytext DEFAULT 'N/A',
          orbital_period tinytext DEFAULT 'N/A',
          diameter tinytext DEFAULT 'N/A',
          climate tinytext DEFAULT 'N/A',
          gravity tinytext DEFAULT 'N/A',
          terrain tinytext DEFAULT 'N/A',
          surface_water tinytext DEFAULT 'N/A',
          population tinytext DEFAULT 'N/A',
          PRIMARY KEY  (id)
        ) $charset_collate;";
        
        $this->star_shipsSQL = "CREATE TABLE table_name (
          id mediumint NOT NULL AUTO_INCREMENT,
          name tinytext NOT NULL,
          model tinytext DEFAULT 'N/A',
          cost_in_credits tinytext DEFAULT 'N/A',
          length tinytext DEFAULT 'N/A',
          crew tinytext DEFAULT 'N/A',
          starship_class tinytext DEFAULT 'N/A',
          PRIMARY KEY  (id)
        ) $charset_collate;";
        
        $this->speciesSQL = "CREATE TABLE table_name (
          id mediumint NOT NULL AUTO_INCREMENT,
          name tinytext NOT NULL,
          language tinytext DEFAULT 'N/A',
          homeworld tinytext DEFAULT 'N/A',
          average_lifespan tinytext DEFAULT 'N/A',
          average_height tinytext DEFAULT 'N/A',
          classification tinytext DEFAULT 'N/A',
          designation tinytext DEFAULT 'N/A',
          PRIMARY KEY  (id)
        ) $charset_collate;";
        
        $this->filmsSQL = "CREATE TABLE table_name (
          episode mediumint NOT NULL,
          name tinytext NOT NULL,
          director tinytext DEFAULT 'N/A',
          producer tinytext DEFAULT 'N/A',
          release_date date,
          PRIMARY KEY  (episode)
        ) $charset_collate;";
        
        $this->vehiclesSQL = "CREATE TABLE table_name (
          id mediumint NOT NULL AUTO_INCREMENT,
          name tinytext DEFAULT 'N/A',
          model tinytext DEFAULT 'N/A',
          manufacturer tinytext DEFAULT 'N/A',
          length tinytext DEFAULT 'N/A',
          crew tinytext DEFAULT 'N/A',
          cost_in_credits tinytext DEFAULT 'N/A',
          vehicle_class tinytext DEFAULT 'N/A',
          PRIMARY KEY  (id)
        ) $charset_collate;";
    }
    
    //builds all tables
    public function buildAll(){
        $this->buildTable($this->personsTab,$this->personSQL);
        $this->buildTable($this->planetsTab,$this->planetSQL);
        $this->buildTable($this->star_shipsTab,$this->star_shipsSQL);
        $this->buildTable($this->speciesTab,$this->speciesSQL);
        $this->buildTable($this->filmsTab,$this->filmsSQL);
        $this->buildTable($this->vehiclesTab,$this->vehiclesSQL);
    }
    
    //this function builds the table
    protected function buildTable($table,$sql){
        global $wpdb;
        $regex = '/table_name/';

        //the table name
        $table_name = $wpdb->prefix . $table;
        
        //replace tabel_name in the sql call
        $sql = preg_replace($regex,$table_name,$sql);
        
        //perform the sql query
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}

//this class's purpose is to remove the tables from the database
class PatrickP_StarWars_RemoveTables extends PatrickP_StarWars_AbstractParent{
    
    //removes all tables
    public function removeAll(){
        $this->removeTable($this->personsTab);
        $this->removeTable($this->planetsTab);
        $this->removeTable($this->star_shipsTab);
        $this->removeTable($this->speciesTab);
        $this->removeTable($this->filmsTab);
        $this->removeTable($this->vehiclesTab);
    }
    
    //remove the passed table
    protected function removeTable($table){
        global $wpdb;

        $table_name = $wpdb->prefix . $table; 

        
        print_r($table_name);
        $sql = "DROP TABLE $table_name;";
        $wpdb->query($sql);
    }
}

//this class's purpose is to insert the data to the database
class PatrickP_StarWars_InsertData extends PatrickP_StarWars_AbstractParent{
    //class members
    
    //these members hold the url strings to the data
    protected $personsURL;
    protected $planetsURL;
    protected $star_shipsURL;
    protected $speciesURL;
    protected $filmsURL;
    protected $vehiclesURL;
    
    //These members will hold the data
    protected $planetData;
    protected $personData;
    protected $speciesData;
    protected $vehiclesData;
    protected $star_shipData;
    protected $filmsData;
    
    public function __construct(){
        parent::__construct();
        
        //initialize the local variables for the urls
        $this->initVaraibles();
    }
    
    //initializes the local variables
    private function initVaraibles(){
        //these are the first pages of the data
        $this->personsURL = "https://swapi.dev/api/people/.json?page=1";
        $this->planetsURL = "https://swapi.dev/api/planets/.json?page=1";
        $this->star_shipsURL = "https://swapi.dev/api/starships/.json?page=1";
        $this->speciesURL = "https://swapi.dev/api/species/.json?page=1";
        $this->filmsURL = "https://swapi.dev/api/films/.json?page=1";
        $this->vehiclesURL = "https://swapi.dev/api/vehicles/.json?page=1";
    }
    
    //gets all the data from the star wars api
    public function insertData(){
        //get the data
        $this->planetData = $this->getData($this->planetsURL);
        /*$this->personData = $this->getData($this->personsURL);
        $this->speciesData = $this->getData($this->speciesURL);
        $this->filmsData = $this->getData($this->filmsURL);
        $this->star_shipData = $this->getData($this->star_shipsURL);
        $this->vehiclesData = $this->getData($this->vehiclesURL);*/
        
        //insert the data
        $this->insertPlanetData();
        /*$this->insertPeopleData();
        $this->insertSpeciesData();
        $this->insertFilmsData();
        $this->insertStarShipData();
        $this->insertVehiclesData();*/
    }
    
    //gets the data for the passedURL
    protected function getData($dataURL){
        //local variables
        $firstSet = json_decode(file_get_contents($dataURL));
        $secondSet;
        $mergedArray = $firstSet->results;
        
        if(isset($firstSet->next)){
            $secondSet = json_decode(file_get_contents($firstSet->next));
            $mergedArray = array_merge($firstSet->results,$secondSet->results);
        }
        
        //continue to add to the mergedArray as long as new data is found
        while(isset($secondSet->next)){
            $secondSet = json_decode(file_get_contents($secondSet->next));
            
            $mergedArray = array_merge($mergedArray,$secondSet->results); 
        }
        
        //check if homeworld exists and needs to be set
        $mergedArray = $this->checkAndSetHomeworld($mergedArray);
        
        //sanitze the data
        $mergedArray = $this->sanitizeSQL($mergedArray);
        
        //return the data
        return $mergedArray;
    }
    
    //checks the input for a homeworld, and sets the correct homeworld if exists
    protected function checkAndSetHomeworld($mergedArray){
        
        
        //set the correct homeworlds by using the planets
        foreach($mergedArray as $dataElement){
            if(isset($dataElement->homeworld)){
                $regExp = "/\d+/i";
                $homeworld; //Holds the index of the homeworld

                preg_match_all($regExp,$dataElement->homeworld,$homeworld);
                $homeworld = $homeworld[0][0] - 1; //Correct index of the homeworld

                $homeworld = $this->planetData[$homeworld]->name;
                $dataElement->homeworld = $homeworld;
            }else{
                $dataElement->homeworld = 'n/a';
            }
        }
        
        return $mergedArray;
    }
    
    //inserts the planet data to the database
    protected function insertPlanetData(){
        global $wpdb;
        $table_name = $wpdb->prefix . $this->planetsTab;
        $sql = array();
        
        //build the array of sql data to insert
        foreach($this->planetData as $planet){
            $sql[] = '("'.$planet->name.'", "'.$planet->rotation_period.'", "'.$planet->orbital_period.'", "'.$planet->diameter.'", "'.$planet->climate.'", "'.$planet->gravity.'", "'.$planet->terrain.'", "'.$planet->surface_water.'", "'.$planet->population.'")';
        }
        
        //insert the data
        $sql = "INSERT INTO {$table_name} (name, rotation_period, orbital_period, diameter, climate, gravity, terrain, surface_water, population) VALUES ".implode(',', $sql);
        $wpdb->query($sql); 
        
    }
    
    //inserts the person data to the database
    protected function insertPeopleData(){
        global $wpdb;
        $table_name = $wpdb->prefix . $this->personsTab;
        $sql = array();
        
        //build the array of sql data to insert
        foreach($this->person as $person){
            $sql[] = '("'.$person->name.'", "'.$person->height.'", "'.$person->mass.'", "'.$person->birth_year.'", "'.$person->gender.'", "'.$person->homeworld.'")';
        }
        
        //insert the data
        $sql = "INSERT INTO {$table_name} (name, height, mass, birth_year, gender, homeworld) VALUES ".implode(',', $sql);
        $wpdb->query($sql); 
        
        /*//insert the data        
        foreach($this->personData as $person){
            $wpdb->insert(
                    $table_name,
                    array(
                            'name' => $person->name,
                            'height' => $person->height,
                            'mass' => $person->mass,
                            'birth_year' => $person->birth_year,
                            'gender' => $person->gender,
                            'homeworld' => $person->homeworld
                    )
            );
        } */
    }
    
    //inserts the species data to the database
    protected function insertSpeciesData(){
        global $wpdb;
        $table_name = $wpdb->prefix . $this->speciesTab; //table name
        $sql = array();
        
        //build the array of sql data to insert
        foreach($this->species as $species){
            $sql[] = '("'.$species->name.'", "'.$species->language.'", "'.$species->homeworld.'", "'.$species->average_lifespan.'", "'.$species->average_height.'", "'.$species->classification.'", "'.$species->designation.'")';
        }
        
        //insert the data
        $sql = "INSERT INTO {$table_name} (name, language, homeworld, average_lifespan, average_height, classification, designation) VALUES ".implode(',', $sql);
        $wpdb->query($sql);
        
        /*//insert the data        
        foreach($this->speciesData as $species){
            $wpdb->insert(
                    $table_name,
                    array(
                            'name' => $species->name,
                            'language' => $species->language,
                            'homeworld' => $species->homeworld,
                            'average_lifespan' => $species->average_lifespan,
                            'average_height' => $species->average_height,
                            'classification' => $species->classification,
                            'designation' => $species->designation
                    )
            );
        }  */
    }
    
    //inserts the film data to the database
    protected function insertFilmsData(){
        global $wpdb;
        $table_name = $wpdb->prefix . $this->filmsTab;
        $sql = array();
        
        //build the array of sql data to insert
        foreach($this->filmsData as $films){
            $sql[] = '("'.$films->episode_id.'", "'.$films->title.'", "'.$films->director.'", "'.$films->producer.'", "'.$films->release_date.'")';
        }
        
        //insert the data
        $sql = "INSERT INTO {$table_name} (episode, name, director, producer, release_date) VALUES ".implode(',', $sql);
        $wpdb->query($sql); 
        
        /*//insert the data        
        foreach($this->filmsData as $films){
            $wpdb->insert(
                    $table_name,
                    array(
                            'episode' => $films->episode_id,
                            'name' => $films->title,
                            'director' => $films->director,
                            'producer' => $films->producer,
                            'release_date' => $films->release_date
                    )
            );
        }  */
    }
    
    //inserts the star ship data to the database
    protected function insertStarShipData(){
        global $wpdb;
        $table_name = $wpdb->prefix . $this->star_shipsTab;
        
        //insert the data        
        foreach($this->star_shipData as $star_ship){
            $wpdb->insert(
                    $table_name,
                    array(
                            'name' => $star_ship->name,
                            'model' => $star_ship->model,
                            'cost_in_credits' => $star_ship->cost_in_credits,
                            'length' => $star_ship->length,
                            'crew' => $star_ship->crew,
                            'starship_class' => $star_ship->starship_class
                    )
            );
        }  
    }
    
    //gets the vehicles data and stores it in the class member
    protected function getVehiclesData(){
        //local variables
        $firstSet = json_decode(file_get_contents($this->vehiclesURL));
        $secondSet;
        
        if($firstSet->next != null){
            $secondSet = json_decode(file_get_contents($firstSet->next));
            
        }
        
        //merged array
        $mergedArray = array_merge($firstSet->results,$secondSet->results);
        
        
        //continue to add to the mergedArray as long as new data is found
        while($secondSet->next != null){
            $secondSet = json_decode(file_get_contents($secondSet->next));
            
            $mergedArray = array_merge($mergedArray,$secondSet->results); 
        }
        
        //store the data
        $this->vehiclesData = $mergedArray;
        
    }
    
    //inserts the vehicles data to the database
    protected function insertVehiclesData(){
        global $wpdb;
        $table_name = $wpdb->prefix . $this->vehiclesTab;
        
        //insert the data        
        foreach($this->vehiclesData as $vehicles){
            $wpdb->insert(
                    $table_name,
                    array(
                            'name' => $vehicles->name,
                            'model' => $vehicles->model,
                            'manufacturer' => $vehicles->manufacturer,
                            'length' => $vehicles->length,
                            'crew' => $vehicles->crew,
                            'cost_in_credits' => $vehicles->cost_in_credits,
                            'vehicle_class' => $vehicles->vehicle_class
                    )
            );
        }  
    }
    
    //this is a utility function used to sanitze data for the mysql call
    protected function sanitizeSQL($table){
        
        //sanitize the values
        foreach($table as $row){
            foreach($row as $col){
                $col = esc_sql($col);
            }
        }
        //return the sanitized table
        return $table;
    }
}

//this class is a controller of the database tables
class PatrickP_StarWars_TableController{
    //local variables
    protected $patrickP_StarWars_CreateTables;
    protected $patrickP_StarWars_RemoveTables;
    protected $patrickP_StarWars_InsertData;
    
    
    public function __construct(){
        //initialize variables
        $this->initVaraibles();
    }
    
    private function initVaraibles(){
        $this->patrickP_StarWars_CreateTables = new PatrickP_StarWars_CreateTables();
        $this->patrickP_StarWars_RemoveTables = new PatrickP_StarWars_RemoveTables();
        $this->patrickP_StarWars_InsertData = new PatrickP_StarWars_InsertData();
    }
    
    public function buildAllTables(){
        $this->patrickP_StarWars_CreateTables->buildAll();
    }
    
    public function insertData(){
        $this->patrickP_StarWars_InsertData->insertData();
    }
    
    public function removeAllTables(){
        $this->patrickP_StarWars_RemoveTables->removeAll();
    }
}
?>