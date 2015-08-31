<?php
/**
 * Adds Corporate Template structures.
 *
 * @package 		Theme Horse
 * @subpackage 	Clean_Retina
 * @since 			Clean Retina 1.2.2
 * @license 		http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link 			http://themehorse.com/themes/clean-retina
 */

add_action( 'cleanretina_corporate_template_content', 'cleanretina_display_corporate_template_content', 10 );
/**
 * Displays the gallery.
 */
function cleanretina_display_corporate_template_content() {
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;
?>
	<div id="content">
		<?php
    	
    	$cleanretina_display_corporate_template_content = '';
		if ( ( !$cleanretina_display_corporate_template_content = get_transient( 'cleanretina_display_corporate_template_content' ) )  ) {	
			if( have_posts() ) {
				while( have_posts() ) {
					the_post();
				   $cleanretina_display_corporate_template_content .= '<h3 class="entry-title">' . '<a href="'. get_permalink() . '" title="'.the_title_attribute( 'echo=0' ) . '">'. get_the_title() . '</a></h3>';
				   $cleanretina_display_corporate_template_content .= '<div class="entry-content clearfix">' . get_the_content() . '</div><!-- .entry-content -->';
				}
			}
			$cleanretina_display_corporate_template_content .= 
			'<div class="services clearfix">';

			$get_featured_pages = new WP_Query( array(
				'posts_per_page' 			=> 3,
				'post_type'					=> 'page',
				'post__in'		 			=> $options[ 'corporate_template_pages' ],
				'orderby' 		 			=> 'post__in'
			));

			global $post;

			while ( $get_featured_pages->have_posts()) : $get_featured_pages->the_post();
				$title_attribute = get_the_title( $post->ID );
				$excerpt = get_the_excerpt();

						$cleanretina_display_corporate_template_content .= 
						'<div class="services-item">';
								$cleanretina_display_corporate_template_content .= '<a href="'. get_permalink() . '" title="' . esc_attr( $title_attribute ) . '">';
							if( has_post_thumbnail() ) {								
								$cleanretina_display_corporate_template_content .= 
									'<span class="service-icon">';
									$cleanretina_display_corporate_template_content .= get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) );
									$cleanretina_display_corporate_template_content .=
									'</span>';
							}
							if( '' != $title_attribute ) {
								$cleanretina_display_corporate_template_content .= '<h4 class="service-title">' . get_the_title() . '</h4>';
							}
							if( '' != $excerpt ) {
								$cleanretina_display_corporate_template_content .= '<p>' . $excerpt . '</p>';
							}
								$cleanretina_display_corporate_template_content .= '</a>';
						$cleanretina_display_corporate_template_content .= 
						'</div>';
				endwhile; wp_reset_query();	
			$cleanretina_display_corporate_template_content .= 			
			'</div>';

			set_transient( 'cleanretina_display_corporate_template_content', $cleanretina_display_corporate_template_content, 86940 );
		}
		echo $cleanretina_display_corporate_template_content;
		?>
	</div><!-- #content -->
<?php
}
?>