<?php
/**
 * Shows the sidebar content.
 *
 * @package 		Theme Horse
 * @subpackage 	Clean_Retina
 * @since 			Clean Retina 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/clean-retina
 */

add_action( 'cleanretina_sidebar', 'cleanretina_display_side_sidebar', 10 );
/**
 * Show widgets of side sidebar.
 *
 * Shows all the widgets that are dragged and dropped on the Side Sidebar.
 */
function cleanretina_display_side_sidebar() {
	// Calling the side sidebar if it exists.
	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'cleanretina_side_sidebar' ) ):
	endif;
}

?>