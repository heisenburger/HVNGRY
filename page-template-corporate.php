<?php
/**
 * Template Name: Corporate Template
 *
 * Displays the Corporate Section of the theme.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.2.2
 */
?>

<?php get_header(); ?>

<?php
	/** 
	 * cleanretina_before_main_container hook
	 */
	do_action( 'cleanretina_before_main_container' );
?>

<div id="container">
	<?php
		/** 
		 * cleanretina_corporate_template_content hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_display_corporate_template_content 10
		 */
		do_action( 'cleanretina_corporate_template_content' );
	?>
</div><!-- #container -->

<?php
	/** 
	 * cleanretina_after_main_container hook
	 */
	do_action( 'cleanretina_after_main_container' );
?>

<?php get_footer(); ?>