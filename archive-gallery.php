<?php
/**
 * Template Name: Archive-gallery Template
 * Displays archive page for gallery.
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
		 * cleanretina_gallery_content hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_display_gallery 10
		 */
		do_action( 'cleanretina_gallery_content' );
	?>
</div><!-- #container -->

<?php
	/** 
	 * cleanretina_after_main_container hook
	 */
	do_action( 'cleanretina_after_main_container' );
?>

<?php get_footer(); ?> 