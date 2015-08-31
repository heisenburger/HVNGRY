<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */

add_action( 'widgets_init', 'cleanretina_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function cleanretina_widgets_init() {
	// Registering main side sidebar
	register_sidebar( array(
		'name' 				=> __( 'Side Sidebar', 'cleanretina' ),
		'id' 					=> 'cleanretina_side_sidebar',
		'description'   	=> __( 'Shows widgets at side.', 'cleanretina' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering footer sidebar
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar', 'cleanretina' ),
		'id' 					=> 'cleanretina_footer_sidebar',
		'description'   	=> __( 'Shows widgets at footer.', 'cleanretina' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  	=> '</aside>',
		'before_title'  	=> '<h3 class="widget-title">',
		'after_title'   	=> '</h3>'
	) );

	// Registering widgets
	register_widget( "cleanretina_custom_tag_widget" );
}

/****************************************************************************************/

/** 
 * Extends class wp_widget
 * 
 * Creates a function CustomTagWidget
 * $widget_ops option array passed to wp_register_sidebar_widget().
 * $control_ops option array passed to wp_register_widget_control().
 * $name, Name for this widget which appear on widget bar.
 */
class cleanretina_custom_tag_widget extends WP_Widget {
	function cleanretina_custom_tag_widget() {
		$widget_ops = array( 'classname' => 'widget_custom-tagcloud', 'description' => __( 'Displays Custom Tag Cloud', 'cleanretina' ) );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::WP_Widget( false, $name = __( 'Theme Horse: Custom Tag Cloud', 'cleanretina' ), $widget_ops, $control_ops );
	}
	
	/** Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = empty( $instance[ 'title' ] ) ? 'Tags' : $instance[ 'title' ];
		
		echo $before_widget;

		if ( $title ):
			echo $before_title . $title . $after_title;
		endif;

		wp_tag_cloud('smallest=16&largest=16px&unit=px');

		echo $after_widget;
	}
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}	
	
	/**
	 * Creates the form for the widget in the back-end which includes the Title 
	 * $instance Current settings
	 */
	function form($instance) {
		$instance = wp_parse_args( ( array ) $instance, array( 'title'=>'Tags' ) );
		$title = esc_attr( $instance[ 'title' ] );
		?>
		
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'cleanretina' ); ?></label> 
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
	<?php			
	}
}