
jQuery(document).ready(()=>{
    let form = jQuery('.' + PPSTARWARSCONST.WIDGET_CLASSNAME);
    
    //listen for input to the search bar
    form.children('input').on('input',keyPressed);
    //perform a search attempt when form submitted
    form.submit(submit);
    
    //functions
    function keyPressed(){
        let val = jQuery(this).val();
        var data = {
			'action': 'patrickp_star_wars_query_hint',
			'search_term': val
		};
        jQuery.get(ajax_object.ajax_url,data,function(response) {
            console.log(response);
        });
        
    }
    
    function submit(){
        let val = jQuery(this).children('input').val();
        var data = {
			'action': 'patrickp_star_wars_query_submit',
			'search_term': val
		};
        jQuery.get(ajax_object.ajax_url,data,function(response) {
            console.log(response);
            displayResults(response);
        });
        
        return false;
    }
    
    //displays the record
    function displayResults(record){
        record = JSON.parse(record);
        record = record[0];
        form.children('ul').remove();
    
        
        form.append('<ul></ul>');
        let ol = form.children('ul');
        
        for(let i in record){
            if(i.localeCompare('id')){
                let regEx = /_/g;
                let col = i.replace(/_/g, " ");
                let printOut = '<div>' + col +':</div>' + '<div>' + record[i] + '</div>';
                ol.append('<li>'+ printOut +'</li>');
            }
        }
        
    }
})