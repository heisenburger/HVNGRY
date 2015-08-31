<?php
/**
 * This file displays home
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */
?>

<?php
   /**
    * cleanretina_before_home_corporate_content
    */
   do_action( 'cleanretina_before_home_corporate_content' );
?>

<?php
   /**
    * cleanretina_home_corporate_content    
	 *
	 * HOOKED_FUNCTION_NAME PRIORITY
	 *
	 * cleanretina_display_home_corporate_content 10
    */
   do_action( 'cleanretina_home_corporate_content' );    
?>

<?php
   /**
    * cleanretina_after_home_corporate_content
    */
   do_action( 'cleanretina_after_home_corporate_content' );
?>