
jQuery(document).ready(()=>{
    //listen for input to the search bar
    jQuery('.' + PPSTARWARSCONST.WIDGET_CLASSNAME).children('input').on('input',keyPressed);
    //perform a search attempt when form submitted
    jQuery('.' + PPSTARWARSCONST.WIDGET_CLASSNAME).submit(submit);
    
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
        let val = jQuery(this).val();
        var data = {
			'action': 'patrickp_star_wars_query_submit',
			'search_term': val
		};
        jQuery.get(ajax_object.ajax_url,data,function(response) {
            console.log(response);
        });
        return false;
    }
})