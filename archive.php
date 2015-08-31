<?php
/**
 * Template Name: Archive Template
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
		 * cleanretina_main_container hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_content 10
		 */
		do_action( 'cleanretina_main_container' );
	?>
</div><!-- #container -->

<?php
	/** 
	 * cleanretina_after_main_container hook
	 */
	do_action( 'cleanretina_after_main_container' );
?>

<?php get_footer(); ?>