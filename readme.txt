Star wars api

table person
	primary key name
	height
	mass
	birth year
	gender
	homeworld
	
table planets
	primary key name
	rotation__period
	orbital_period
	diameter
	climate
	gravity
	terrain
	surface_water
	population
	
table starships
	primary key name
	model
	cost_in_credits
	length
	crew
	starship_class
	
table films
	primary key episode_id
	title
	director
	producter
	release_date
	
table vehicles
	primary key name
	model
	manufacturer
	length
	crew
	cost_in_credits
	vehicle_class
	
table species
	primary key name
	language
	homeworld
	average_lifespan
	average_height
	classification
	designation