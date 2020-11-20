
jQuery(document).ready(()=>{
    //listen for input to the search bar
    jQuery('.' + PPSTARWARSCONST.WIDGET_CLASSNAME).children('input').keyup(keyPressed);
    
    
    
    //functions
    function keyPressed(){
        let val = jQuery(this).val();
        var data = {
			'action': 'patrickp_star_wars_query',
			'search_term': val
		};
        jQuery.get(ajax_object.ajax_url,data,function(response) {
            console.log(response);
        });
        
    }
})