<?php
/**
 * Displays the sidebar section of the theme.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */
?>

<?php
	/**
	 * cleanretina_before_sidebar
	 */
	do_action( 'cleanretina_before_sidebar' );
?>

<?php
	/** 
	 * cleanretina_sidebar hook
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * cleanretina_display_side_sidebar 10
	 */
	do_action( 'cleanretina_sidebar' );
?>

<?php
	/**
	 * cleanretina_after_sidebar
	 */
	do_action( 'cleanretina_after_sidebar' );
?>