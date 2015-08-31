<?php
/**
 * This file displays page with left sidebar.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */
?>

<?php
   /**
    * cleanretina_before_primary
    */
   do_action( 'cleanretina_before_primary' );
?>

<div id="primary">
   <?php
      /**
       * cleanretina_before_loop_content
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_loop_before 10
       */
      do_action( 'cleanretina_before_loop_content' );

      /**
       * cleanretina_loop_content
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_theloop 10
       */
      do_action( 'cleanretina_loop_content' );

      /**
       * cleanretina_after_loop_content
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * cleanretina_next_previous 5
		 * cleanretina_loop_after 10
       */
      do_action( 'cleanretina_after_loop_content' );      
   ?>
</div><!-- #primary -->

<?php
   /**
    * cleanretina_after_primary
    */
   do_action( 'cleanretina_after_primary' );
?>

<div id="secondary" class="no-margin-left">
	<?php get_sidebar(); ?>
</div><!-- #secondary -->