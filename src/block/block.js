/**
 * BLOCK: search-star-wars
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { Fragment } = wp.element;
const { Component } = wp.element;

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'search-star-wars/block-search-star-wars', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'search star wars' ), // Block title.
	icon: 'star-empty', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'widgets', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'search star wars' ),
		__( 'star wars' ),
		__( 'search' ),
        __('star'),
	],
    attributes:{
        id:{
          type:'string'
        },
        title:{
            type:'string',
            default:''
        }
    
    },
    supports:{
        align:['left','center','right']
    },

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Component.
	 */
    
    //This block editor allows the user to edit the title directly by clicking on it
	edit: class StarWarsSearchBlock extends Component{
        constructor(props){
            super(props);
            
            let {setAttributes} = this.props;
            let idPrefix = PPSTARWARSCONST.WIDGET_CLASSNAME; //ensure unique id name
            let id = idPrefix.concat(StarWarsSearchBlock.index++);
            
            setAttributes({
                id:id
            });
            
            this.upDateTitle = this.upDateTitle.bind(this);
        }
        
        //updates the title value when input is entered
        upDateTitle(title){
            let {setAttributes} = this.props;
            
            setAttributes({
                title:title.target.value
            });
        }
        
        static index = 0;
        render(){
            let {attributes} = this.props;
    
            let id = attributes.id;
            let title = attributes.title;
            return(
                <Fragment>
                    <div className={PPSTARWARSCONST.WIDGET_BLOCK_EDITOR_CLASSNAME}>
                        <form>
                            <input value={title} type='text' placeholder = {PPSTARWARSCONST.WIDGET_DEFAULT_TITLE} onChange={this.upDateTitle}/>
                            <p> Search </p>
                        </form> 
                    </div>
                </Fragment>
            );
        }
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 *
	 * @param {Object} props Props.
	 * @returns {Mixed} JSX Frontend HTML.
	 */
	save: ( props ) => {
    
        //initiate reference
        let {attributes} = props;
        
        let id = attributes.id;
        let title = attributes.title;
        
        //use default title if no title entered
        if(title === ""){
            title = PPSTARWARSCONST.WIDGET_DEFAULT_TITLE;
        }
		return (
                <div>
                    <div className={PPSTARWARSCONST.WIDGET_CLASSNAME}>
                        <form>
                            <label className={PPSTARWARSCONST.WIDGET_HEADER} for={id}>{title}</label>
                            <input className={PPSTARWARSCONST.WIDGET_SEARCHBAR} id={id} placeholder='Search' type='search'/>
                        </form> 
                    </div>
                </div>
		);
	},
} );
