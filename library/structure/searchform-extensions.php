<?php
/**
 * Renders the search form of the theme.
 *
 * @package 		Theme Horse
 * @subpackage 	Clean_Retina
 * @since 			Clean Retina 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/clean-retina
 */

add_action( 'cleanretina_searchform', 'cleanretina_display_searchform', 10 );
/**
 * Displaying the search form.
 *
 */
function cleanretina_display_searchform() {
?>
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform clearfix" method="get">
		<label class="assistive-text" for="s"><?php _e( 'Search', 'cleanretina' ); ?></label>
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'cleanretina' ); ?>" class="s field" name="s">
	</form><!-- .searchform -->
<?php
}
?>