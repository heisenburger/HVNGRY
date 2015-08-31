<?php
/**
 * Displays the header section of the theme.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<?php		
		/** 
		 * cleanretina_title hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_add_meta 5
		 * cleanretina_show_title 10
		 *
		 */
		do_action( 'cleanretina_title' );

		/** 
		 * cleanretina_meta hook
		 */
		do_action( 'cleanretina_meta' );

		/** 
		 * cleanretina_links hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_add_links 10
		 * cleanretina_favicon 15
		 * cleanretina_webpageicon 20
		 *
		 */
		do_action( 'cleanretina_links' );

		/** 
		 * This hook is important for wordpress plugins and other many things
		 */
		wp_head();
	?>

</head>

<body <?php body_class(); ?>>
	<?php
		/** 
		 * cleanretina_before hook
		 */
		do_action( 'cleanretina_before' );
	?>

	<div id="wrapper">
		<?php
			/** 
			 * cleanretina_before_header hook
			 */
			do_action( 'cleanretina_before_header' );
		?>
		<header id="branding" >
			<?php
				/** 
				 * cleanretina_header hook
				 *
				 * HOOKED_FUNCTION_NAME PRIORITY
				 *
				 * cleanretina_headerdetails 10
				 */
				do_action( 'cleanretina_header' );
			?>
		</header>
		<?php
			/** 
			 * cleanretina_after_header hook
			 */
			do_action( 'cleanretina_after_header' );
		?>

		<?php
			/** 
			 * cleanretina_before_main hook
			 */
			do_action( 'cleanretina_before_main' );
		?>
		<div id="main" class="wrapper clearfix">
