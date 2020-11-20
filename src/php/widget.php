<?php
class PatrickP_Star_Wars_Widget extends WP_Widget {
    //member variables
    protected $formInputID;
    protected $titleFieldName;
    protected $widgetID;
    protected $defaultTitleFieldName;
    protected $widgetPlaceHolder;
    protected $widgetClass;
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'star_wars_widget', // Base ID
            'Search Star Wars', // Name
            array( 'description' => 'Get info on characters,planets, and etc.', ) // Args
        );
        
        //initialize variables
        $this->initiVariables();
    }
    
    protected function initiVariables(){
        //these are the member variables
        $this->formInputID = 'title_input'; //used in the form and update methods
        $this->titleFieldName = 'title_name'; //this is the input fields name, used to access data instance
        $this->widgetID = 'searchBar'; //this is the individual widget id
        $this->defaultTitleFieldName = 'Search Star Wars'; //Default title name for the star wars search bar
        $this->widgetPlaceHolder = 'Search';
        $this->widgetClass = 'starWarsWidget';
    }
 
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        
        $widgetID = $this->get_field_id($this->widgetID); //full ID
        
        //display the widget
        echo $before_widget;
    
        echo "
            <div class='{$this->widgetClass}'>
                <label for='{$widgetID}'>{$instance[$this->titleFieldName]} </label>
                <input id='{$widgetID}' placeholder='$this->widgetPlaceHolder'type='text'>
            </div> ";
        echo $after_widget;
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        if ( isset( $instance[ $this->titleFieldName ] ) ) {
            $title = $instance[ $this->titleFieldName ];
        }
        else {
            $title = $this->defaultTitleFieldName;
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( $this->formInputID ); ?>"><?php echo 'Title:'; ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( $this->formInputID ); ?>" name="<?php echo $this->get_field_name( $this->titleFieldName ); ?>" type="text" value="<?php echo $title; ?>" />
         </p>
    <?php
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance[$this->titleFieldName] = ( !empty( $new_instance[$this->titleFieldName] ) ) ? strip_tags( $new_instance[$this->titleFieldName] ) : '';
    
        return $instance;
    }
}

?>