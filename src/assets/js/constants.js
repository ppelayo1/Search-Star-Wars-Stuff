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
    
    
    WIDGET_LEFT_TEXT:'starWarsWidgetLeftHeader', //needed to remove the old class
    WIDGET_LEFT_COL: 'starWarsLeftCol', //The left div column in the ul
    WIDGET_RIGHT_COL: 'starWarsRightCol', //the right div column in the ul
    
    WIDGET_LEFT_COL_450PX: 'starWarsLeftCol450px', //applied when the widget is under 450px
    WIDGET_RIGHT_COL_450PX: 'starWarsRightCol450px', //applied when the widget is under 450px
    WIDGET_INPUT_450PX:'starWarsInput450px',
    WIDGET_LABEL_450PX:'starWarsLabel450px'
};