
jQuery(document).ready(()=>{
    let form = jQuery('.' + PPSTARWARSCONST.WIDGET_CLASSNAME).children('form');
    
    //listen for input to the search bar
    setUpHintHandler();
    
    //perform a search attempt when form submitted
    form.submit(submit);
    
    //functions
    
    //This function sets up the auto complete hint handler for each star wars search widget
    function setUpHintHandler(){
        let input = jQuery(form).children('input');
        
        jQuery(input).each(function () {
            jQuery(this).autocomplete({
                delay:0,
                source:(request,response)=>{
                    let data = {
                    'action': 'patrickp_star_wars_query_hint',
                    'search_term': request.term  
                    };

                    jQuery.get(ajax_object.ajax_url,data,function(responseData){
                        let source = [];//the source that the auto complete will use
                        responseData = JSON.parse(responseData);
                        
                        //need to build an array of names from the returned get data
                        for(let i = 0; i < responseData.length;i++){
                            source.push(responseData[i].name);
                        }
                        response(source);
                    });
                }
            })
        })
        
    }
    
    //handles the query when the user presses enter or presses the submit button
    function submit(){
        let val = jQuery(this).children('input').val();
        let widgetWrapper = jQuery(this).parent();
        var data = {
			'action': 'patrickp_star_wars_query_submit',
			'search_term': val
		};
        jQuery.get(ajax_object.ajax_url,data,function(response) {
            
            response = JSON.parse(response);
            if(!jQuery.isEmptyObject(response)){
                displayResults(response,widgetWrapper);
            }
        });
        
        return false;
    }
    
    //displays the record
    function displayResults(record,widgetWrapper){
    
        record = record[0];
        
        widgetWrapper.children('ul').remove();
        widgetWrapper.append('<ul></ul>');
        let ol = widgetWrapper.children('ul');
        
        for(let i in record){
            if(i.localeCompare('id')){
                let regEx = /_/g;
                let col = i.replace(regEx, " ");
                let printOut = '<div>' + col +':</div>' + '<div>' + record[i] + '</div>';
                ol.append('<li class="' + PPSTARWARSCONST.OUTPUT_CLASSNAME +'">'+ printOut +'</li>');
            }
        }   
    }
})