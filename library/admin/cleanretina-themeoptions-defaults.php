<?php
/**
 * Contains all the theme option default values
 * 
 * Set the default values for all the settings. If no user-defined values
 * is available for any setting, these defaults will be used.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */

global $cleanretina_theme_options_defaults;
$cleanretina_theme_options_defaults = array(
	'hide_header_searchform'			=> '0',
 	'disable_slogan' 						=> '0',
 	'home_slogan1'							=> '',
 	'home_slogan2'							=> '',
 	'slogan_position'						=> 'above-slider',
 	'disable_slider'						=> '0',
 	'exclude_slider_post'				=> '0',
 	'default_layout'						=> 'right-sidebar',
 	'home_page_layout'					=> 'right-sidebar',
 	'blog_display_type'					=> 'excerpt_display_one',
 	'corporate_content_title'			=> '',
 	'featured_home_box_image'			=> array(),
 	'featured_home_box_link'			=> array(),
 	'featured_home_box_title'			=> array(),
 	'featured_home_box_description'	=> array(),
 	'reset_layout'							=> '0',
 	'custom_css'							=> '',
 	'disable_favicon'						=> '1',
 	'favicon'								=> '',
 	'disable_webpageicon'				=> '1',
 	'webpageicon'							=> '',
 	'slider_quantity' 					=> '4',
 	'featured_post_slider'				=> array(),
 	'transition_effect'					=> 'fade',
 	'transition_delay'					=> '4',
 	'transition_duration'				=> '1',
 	'social_facebook' 					=> '',
 	'social_twitter' 						=> '',
 	'social_googleplus' 					=> '',
 	'social_pinterest' 					=> '',
 	'social_vimeo' 						=> '',
 	'social_linkedin' 					=> '',
 	'social_flickr' 						=> '',
 	'social_tumblr' 						=> '',
 	'social_myspace' 						=> '',
 	'social_rss' 							=> '',
 	'social_youtube'						=> '',
 	'analytic_header' 					=> '',
 	'analytic_footer' 					=> '',
 	'feed_url'								=> '',
 	'front_page_category'				=> array(),
 	'corporate_template_pages'			=> array(
 														'1'	=>'',
 														'2'	=>'',
 														'3'	=>''
 														),
 	'excerpt_length'						=> 30

 );
global $cleanretina_theme_options_settings;
$cleanretina_theme_options_settings = cleanretina_theme_options_set_defaults( $cleanretina_theme_options_defaults );

function cleanretina_theme_options_set_defaults( $cleanretina_theme_options_defaults) {
	$cleanretina_theme_options_settings = array_merge( $cleanretina_theme_options_defaults, (array) get_option( 'cleanretina_theme_options', array() ) );
	return apply_filters( 'cleanretina_theme_options_settings', $cleanretina_theme_options_settings );
}

?>