<?php
/**
 * Displays the 404 error page of the theme.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */
?>

<?php get_header(); ?>

<?php
	/** 
	 * cleanretina_404_content hook
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * cleanretina_display_404_page_content 10
	 */
	do_action( 'cleanretina_404_content' );
?>

<?php get_footer(); ?>