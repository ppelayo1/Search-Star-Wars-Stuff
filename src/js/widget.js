
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
            
            
            jQuery(input).each(function () {
                let searchArray = []; //needed to store the autocomplete data for the keyup event handler

                jQuery(this).autocomplete({
                    delay:delay,
                    minLength:minLength,
                    source:function(request,response) {source(request,response,searchArray);},
                    select:(event,ui)=>{StarWarsAjax.autoCompleteSubmit(this,ui.item.value);} //perform a search query if user clicks on a name
                }).keyup(function (e) {keyUp.call(this,e,searchArray);}); 
            })
            
            //these functions are used in the jQuery autocomplete, these are helper functions for this class's function only
                
            //this performs the ajax call,sets the response list for the auto complete, and returns the list
            function source(request,response,searchArray){
                //empty searchArray
                searchArray = [];
                
                let data = {
                        'action': PPSTARWARSCONST.ACTION_AJAX_HINT,
                        'search_term': request.term  
                    };

                    jQuery.get(ajax_object.ajax_url,data,function(responseData){
                        responseData = JSON.parse(responseData);

                        //need to build an array of names from the returned get data
                        for(let i = 0; i < responseData.length;i++){
                            searchArray.push(responseData[i].name);
                        }
                        response(searchArray);
                        console.log(searchArray);
                    });
            }
            
            //handles the keyup event, closes the auto complete when enter key is pressed and a valid input is submited
            function keyUp(e,searchArray){
                //variables
                let tempArray = []; //temp holds the autocomplete data in lower case
                let input = jQuery(this).val(); //just the input held in the text box
                
                input = input.toLowerCase(); //set that input lower case
                
                //set the autocomplete data to lower case
                for(let i = 0; i < searchArray.length;i++){
                    tempArray.push(searchArray[i].toLowerCase());
                }
                
                //close auto complete if enter key pressed and a search term is matched
                if(e.keyCode == 13 && (tempArray.indexOf(input) >= 0)){
                    jQuery(this).autocomplete('close');
                }
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
            record = record[0]; //one element array, removing it from an array by re-asigning.

            //create the ul
            widgetWrapper.children('ul').remove();
            widgetWrapper.append('<ul></ul>');
            let ol = widgetWrapper.children('ul');

            //displays all the columns of the record
            for(let i in record){
                if(i.localeCompare('id')){
                    let regEx = /_/g;
                    let col = i.replace(regEx, " ");
                    let printOut = '<div>' + col +':</div>' + '<div>' + record[i] + '</div>';
                    ol.append('<li class="' + PPSTARWARSCONST.OUTPUT_CLASSNAME +'">'+ printOut +'</li>');
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