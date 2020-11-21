
jQuery(document).ready(()=>{
    let form = jQuery('.' + PPSTARWARSCONST.WIDGET_CLASSNAME).children('form');
    
    //listen for input to the search bar
    form.children('input').on("input",keyPressed);
    //perform a search attempt when form submitted
    form.submit(submit);
    
    /*jQuery(form).children('input').index(0).autocomplete({
        source:['bob']
    });*/
    
    jQuery('#widget-star_wars_widget-5-searchBar').autocomplete({
            delay:0,
            source:(request,response)=>{
                var data = {
                'action': 'patrickp_star_wars_query_hint',
                'search_term': request  
                };

                console.log(request);
                jQuery.get(ajax_object.ajax_url,data,function(test){
                    let source = [];
                    test = JSON.parse(test);
                    for(let i = 0; i < test.length;i++){
                        source.push(test[i].name);
                    }
                    response(source);
                    
                });
            }
        });
    
    //functions
    function keyPressed(){
        
        let val = jQuery(this).val();
        let id = '#' + jQuery(this).attr("id");
        //console.log(val);
        var data = {
			'action': 'patrickp_star_wars_query_hint',
			'search_term': val
		};
        
        
        
        /*jQuery.get(ajax_object.ajax_url,data,function(response) {
            response = JSON.parse(response);
            
            
            //convert into arrays
            let source = [];
            for(let i = 0; i < response.length;i++){
                source.push(response[i].name);
            }
            console.log(source);
            
            jQuery(id).autocomplete({
                source:source,
                delay:300,
                minLength:0
            });
        });*/
        
    }
    
    function submit(){
        let val = jQuery(this).children('input').val();
        var data = {
			'action': 'patrickp_star_wars_query_submit',
			'search_term': val
		};
        jQuery.get(ajax_object.ajax_url,data,function(response) {
            
            response = JSON.parse(response);
            if(!jQuery.isEmptyObject(response)){
                displayResults(response);
            }
        });
        
        return false;
    }
    
    //displays the record
    function displayResults(record){
    
        record = record[0];
        let widgetWrapper = form.parent();
        
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