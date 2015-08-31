<?php
/**
 * Contains all the shortcodes of the theme.
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */

/**
 * To display the current year.
 *
 * @uses date() Gets the current year.
 * @return string
 */
function cleanretina_the_year() {
   return date( 'Y' );
}
/**
 * To display a link back to the site.
 *
 * @uses get_bloginfo() Gets the site link
 * @return string
 */
function cleanretina_site_link() {
   return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}
/**
 * To display a link to WordPress.org.
 *
 * @return string
 */
function cleanretina_wp_link() {
   return '<a href="'.esc_url( 'http://wordpress.org' ).'" target="_blank" title="' . esc_attr__( 'WordPress', 'cleanretina' ) . '"><span>' . __( 'WordPress', 'cleanretina' ) . '</span></a>';
}
/**
 * To display a link to cleanretina.com.
 *
 * @return string
 */
function cleanretina_themehorse_link() {
   return '<a href="'.esc_url( 'http://themehorse.com' ).'" target="_blank" title="'.esc_attr__( 'Theme Horse', 'cleanretina' ).'" ><span>'.__( 'Theme Horse', 'cleanretina') .'</span></a>';
}
?>
