//This object will store all plugin JS wide variables
let PPSTARWARSCONST = {
    WIDGET_CLASSNAME: 'starWarsWidget', //This is the class name of the widget in widget.php
    OUTPUT_CLASSNAME: 'starWarsOutput', //The class name for each output item in the list
    FOCUSED_AUTOCOMPLETE_CLASS:'auto-complete-active', //This class will highligh the focused autocomplete term
    ACTION_AJAX_HINT: 'patrickp_star_wars_query_hint', //The wordpress action for the ajax hint call
    ACTION_AJAX_SUBMIT: 'patrickp_star_wars_query_submit', //The wordpress action for the ajax submit call
    WIDGET_BLOCK_EDITOR_CLASSNAME: 'starWarsEditor', //needed for styling from the block editor
    WIDGET_DEFAULT_TITLE: 'Search Star Wars', //default name displayed if none entered by user
    WIDGET_MAX_WIDTH:324, //max width the widget should change, but some themes will manage to change it larger
    
    WIDGET_HEADER:'starWarsWidgetHeader', //needed to remove the old class
    WIDGET_SEARCHBAR: 'starWarsSearchBar', //class for the search bar
    WIDGET_LEFT_COL: 'starWarsLeftCol', //The left div column in the ul
    WIDGET_RIGHT_COL: 'starWarsRightCol', //the right div column in the ul
    
    //used by javascript to make the widget responsive when width of widget decreases
    //323px
    WIDGET_323PX:323, //represents 323 pixels
    WIDGET_LEFT_COL_323PX: 'starWarsLeftCol323px', 
    WIDGET_RIGHT_COL_323PX: 'starWarsRightCol323px', 
    WIDGET_INPUT_323PX:'starWarsInput323px',
    WIDGET_HEADER_323PX:'starWarsHeader323PX',
    
    //288px
    WIDGET_288PX:288, //represents 450 pixels
    WIDGET_LEFT_COL_288PX: 'starWarsLeftCol288px', 
    WIDGET_RIGHT_COL_288PX: 'starWarsRightCol288px', 
    WIDGET_INPUT_288PX:'starWarsInput288px',
    WIDGET_HEADER_288PX:'starWarsHeader288PX'
};