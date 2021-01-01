
jQuery(document).ready(()=>{
    class StarWarsAjax{
        //class members
        form; //holds jQuery object of all starwars widgets
        
        constructor(){
            //this function initizalizes the variables and event handlers
            this.initialize();
        }
        //initialize all variables and set up event handlers
        initialize(){
            this.form = jQuery('.' + PPSTARWARSCONST.WIDGET_CLASSNAME).children('form');
            this.form.submit(this.submit);
            
            this.setUpHintHandler();
        }
        
        setUpHintHandler(){
            let input = jQuery(this.form).children('input');
            let delay = 0; //delay in ms for the auto complete to appear
            let minLength = 2; //min length of string input before generating auto complete list
            let autoFocus = true;
            
            jQuery(input).each(function () {
                //needed to store the autocomplete data for the keyup event handler, forced as object to pass by reference
                let searchArray = {
                    searchArray:[]
                }; 
                
                jQuery(this).autocomplete({
                    delay:delay,
                    autoFocus:autoFocus,
                    minLength:minLength,
                    focus:function(event,ui){focused(event,ui);},
                    source:function(request,response) {source(request,response,searchArray);},
                    select:(event,ui)=>{StarWarsAjax.autoCompleteSubmit(this,ui.item.value);} //perform a search query if user clicks on a name
                }).keyup(function (e) {keyUp.call(this,e,searchArray.searchArray);}); 
            })
            
            //these functions are used in the jQuery autocomplete, these are helper functions for this class's function only
                
            //this performs the ajax call,sets the response list for the auto complete, and returns the list
            function source(request,response,searchArray){
                //array to hold the data
                let source = [];
                let maxListSize = 7; //max size of the autocomplete list
                
                let data = {
                        'action': PPSTARWARSCONST.ACTION_AJAX_HINT,
                        'search_term': request.term  
                    };

                    jQuery.get(ajax_object.ajax_url,data,function(responseData){
                        responseData = JSON.parse(responseData);

                        //need to build an array of names from the returned get data
                        for(let i = 0; i < responseData.length && i < maxListSize;i++){
                            source.push(responseData[i]);
                        }
                        response(source);
                        searchArray.searchArray = source;
                    });
            }
            
            //handles the keyup event, closes the auto complete when enter key is pressed and a valid input is submited
            function keyUp(e,searchArray){
                //variables
                let tempArray = []; //temp holds the autocomplete data in lower case
                let input = jQuery(this).val(); //just the input held in the text box
                let keyCodes = {
                    enter:13,
                };
            
                input = input.toLowerCase(); //set that input lower case
                
                //set the autocomplete data to lower case
                for(let i = 0; i < searchArray.length;i++){
                    tempArray.push(searchArray[i].toLowerCase());
                }
                
                //close auto complete if enter key pressed and a search term is matched
                if(e.keyCode == keyCodes.enter && (tempArray.indexOf(input) >= 0)){
                    jQuery(this).autocomplete('close');
                }
            }
            
            //focus handler
            function focused(e,ui){
                let value = ui.item.value;//the focused autocomplete term
                let autoCompleteList = jQuery(e.currentTarget).children(); //the list of autocomplete terms
                
                //need to remove the focused class from all the terms, then put it on the only focused one
                jQuery(autoCompleteList).each(function (){jQuery(this).removeClass(PPSTARWARSCONST.FOCUSED_AUTOCOMPLETE_CLASS);});
                let element = jQuery(autoCompleteList).filter(function (i){
                    return !jQuery(this).text().localeCompare(value);
                });
                jQuery(element).addClass(PPSTARWARSCONST.FOCUSED_AUTOCOMPLETE_CLASS);
            }
        }
        
        //this function performs the ajax calls
        static performAjax(val,widgetWrapper){
            var data = {
                'action': PPSTARWARSCONST.ACTION_AJAX_SUBMIT,
                'search_term': val
            };
            
            
            jQuery.get(ajax_object.ajax_url,data,function(response) {
                
                response = JSON.parse(response);
                if(!jQuery.isEmptyObject(response)){
                    StarWarsAjax.displayResults(response,widgetWrapper);
                }
            });
        }
        
        //this function displays the results
        static displayResults(record,widgetWrapper){
            

            //create the ul
            widgetWrapper.children('ul').remove();
            widgetWrapper.append('<ul></ul>');
            let ol = widgetWrapper.children('ul');

            //displays all the columns of the record
            for(let i in record){
                if(i.localeCompare('id')){
                    let regEx = /_/g;
                    let col = i.replace(regEx, " ");
                    col = col.charAt(0).toUpperCase() + col.slice(1); //set first letter to uppercase
                    record[i] = modifyResults(i,record[i]);
                    
                    let printOut = '<div>' + col +':</div>' + '<div>' + record[i] + '</div>';
                    ol.append('<li class="' + PPSTARWARSCONST.OUTPUT_CLASSNAME +'">'+ printOut +'</li>');
                }
            }
            
            
            //function to take the record and modify the output depending on type of table
            function modifyResults(col,recordVal){
                
                //These are columns of the record that need to have their output adjusted
                let person = {
                    height:'height',
                    mass:'mass'
                };
                let planet = {
                    rotation_period:'rotation_period',
                    orbital_period:'orbital_period',
                    diameter:'diameter',
                    surface_water:'surface_water'
                };
                let shipsNvehicles = {
                    length:'length'
                };
                
                let species = {
                    average_lifespan:'average_lifespan',
                    average_height:'average_height'
                };
                
                switch(col){
                    //person
                    case person.height:
                        recordVal = cmToFtInch(recordVal);
                        break;
                    
                    case person.mass:
                        recordVal = kgToLb(recordVal);
                        break;
                        
                    //planets
                    case planet.rotation_period:
                        recordVal+= (isNaN(recordVal) ? '' : ' hours' );
                        break;
                    
                    case planet.orbital_period:
                        recordVal+= (isNaN(recordVal) ? '' : ' days' );
                        break;
                        
                    case planet.diameter:
                        recordVal+=(isNaN(recordVal) ? '' : 'km' );
                        break;
                    
                    case planet.surface_water:
                        recordVal+=(isNaN(recordVal) ? '' : '%' );
                        break;
                    //ships and vehicles
                    case shipsNvehicles.length:
                        recordVal+= (isNaN(recordVal) ? '' : 'm' );
                        break;
                        
                    //species
                    case species.average_height:
                        recordVal = cmToFtInch(recordVal);
                        break;
                    
                    case species.average_lifespan:
                        recordVal+= (isNaN(recordVal) ? '' : ' yrs' );
                        break;
                }
                return recordVal;
                
                //utility function
                function cmToFtInch(cm){
                    let returnVal = cm;
                    
                    if(!isNaN(cm)){
                        let inch = Math.round(cm/2.54);
                        let feet = parseInt(inch/12); //final feet
                        inch = inch - (feet * 12);      //final inches

                        returnVal = feet + "ft " + inch + "in";
                    }
                    return returnVal;
                }
                
                function kgToLb(kg){
                    let returnVal = kg;
                    
                    if(!isNaN(kg)){
                        let lb = Math.round(kg / 0.45359237);
                        returnVal = lb + 'lb';
                    }
                    return returnVal;
                }
            }
            
        }
        
        //the two types of submit functions, one for a enter submit, the other for a click of auto complete submit
        
        //called when enter key pressed
        submit(){
            let val = jQuery(this).children('input').val();
            let widgetWrapper = jQuery(this).parent();
            
            StarWarsAjax.performAjax(val,widgetWrapper);

            return false; //don't want the submit to redirect
        }
        
        //clicking a name in the auto complete list
        static autoCompleteSubmit(inputElement,val){
            let widgetWrapper = jQuery(inputElement).parent().parent();

            StarWarsAjax.performAjax(val,widgetWrapper);
        }
        
    }
    
    new StarWarsAjax();//initialize the widget
})