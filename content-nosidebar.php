<?php
/**
 * This file displays page with no sidebar.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */
?>


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
	 * cleanretina_loop_after 10
    */
   do_action( 'cleanretina_after_loop_content' );      
?>