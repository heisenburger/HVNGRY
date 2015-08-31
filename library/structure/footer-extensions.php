<?php
/**
 * Adds footer structures.
 *
 * @package 		Theme Horse
 * @subpackage 	Clean_Retina
 * @since 			Clean Retina 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/clean-retina
 */

add_action( 'cleanretina_footer', 'cleanretina_open_wrapper_div', 5 );
/**
 * Opens the wrapper div.
 */
function cleanretina_open_wrapper_div() {
	echo '<div class="wrapper">';
}

/****************************************************************************************/

add_action( 'cleanretina_footer', 'cleanretina_footer_widget_area', 10 );
/** 
 * Displays the footer widgets
 */
function cleanretina_footer_widget_area() {
	if( is_active_sidebar( 'cleanretina_footer_sidebar' ) ) {
		?>
		<div class="widget-area clearfix">
			<?php
			// Calling the left footer sidebar if it exists.
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'cleanretina_footer_sidebar' ) ):
			endif;
			?>
      </div><!-- .widget-area -->
      <hr />
      <?php
	}
}

/****************************************************************************************/

add_action( 'cleanretina_footer', 'cleanretina_open_sitegenerator_div', 15 );
/**
 * Opens the wrapper div.
 */
function cleanretina_open_sitegenerator_div() {
	echo '<div id="site-generator">';
}

/****************************************************************************************/

add_action( 'cleanretina_footer', 'cleanretina_socialnetworks', 20 );

/****************************************************************************************/

add_action( 'cleanretina_footer', 'cleanretina_footer_info', 25 );
/**
 * function to show the footer info, copyright information
 */
function cleanretina_footer_info() {         
   $output = '<div class="copyright">'.__( '&copy; [site-link]', 'cleanretina' ).' '.'[the-year] | <a href="/about">About</a> | <a href="/contact">Contact</a> | <a href="/legal">Legal</a>'.'</div><!-- .copyright -->';
   echo do_shortcode( $output );
}

/****************************************************************************************/

add_action( 'cleanretina_footer', 'cleanretina_close_sitegenerator_div', 30 );
/**
 * Closes the wrapper div.
 */
function cleanretina_close_sitegenerator_div() {
	echo '<div style="clear:both;"></div>
			</div><!-- #site-generator -->';
}

/****************************************************************************************/

add_action( 'cleanretina_footer', 'cleanretina_close_wrapper_div', 35 );
/**
 * Closes the wrapper div.
 */
function cleanretina_close_wrapper_div() {
	echo '</div><!-- .wrapper -->';
}

add_action( 'cleanretina_footer', 'cleanretina_backtotop_html', 40 );
/**
 * Shows the back to top icon to go to top.
 */
function cleanretina_backtotop_html() {
	echo '<div class="back-to-top"><a href="#branding">'.__( 'Back to Top', 'cleanretina' ).'</a></div>';
}

?>