<?php
/**
 * Adds gallery archive structures.
 *
 * @package 		Theme Horse
 * @subpackage 	Clean_Retina
 * @since 			Clean Retina 1.0
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/clean-retina
 */

add_action( 'cleanretina_gallery_content', 'cleanretina_display_gallery', 10 );
/**
 * Displays the gallery.
 */
function cleanretina_display_gallery() {
?>
	<div id="content" class="clearfix">
		<div class="custom-gallery clearfix">
		<?php 
		global $post;
      if( have_posts() ):
        while ( have_posts() ) : the_post();
          $output = '<dl class="custom-gallery-item">';
          if( has_post_thumbnail() ) {
            $output .= '<dt class="custom-gallery-icon">';
            $large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
            $output .= '<a rel="portfolio" href="'.$large[0].'" class="gallery-fancybox" title="'.the_title_attribute('echo=0').'">'.get_the_post_thumbnail( $post->ID, 'gallery', array( 'title' => get_the_title(), 'alt' => get_the_title() ) ).'</a></dt>';
          }
          $output .= '<dd><h4 class="custom-gallery-title">'.get_the_title().'</h4></dd>';
          $output .= '</dl>'; 
          echo $output;        
        endwhile;
      else:
      ?>
        <h3 class="entry-title"><?php _e( 'No Posts for this Custom Post Type', 'cleanretina' ); ?></h3>
      <?php
      endif;
		?>		
		</div><!-- .gallery -->

		<?php do_action( 'cleanretina_before_nav' ); ?>

		<?php
			if( function_exists( 'cleanretina_next_previous' ) ) {
				cleanretina_next_previous();
			}
		?>

		<?php do_action( 'cleanretina_after_nav' ); ?>

	</div><!-- #content -->
<?php
}
?>