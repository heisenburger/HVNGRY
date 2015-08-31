<?php
/**
 * Clean Retina functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 * 
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */

/****************************************************************************************/

add_action( 'wp_enqueue_scripts', 'cleanretina_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function cleanretina_scripts_styles_method() {

	global $cleanretina_theme_options_settings;
   $options = $cleanretina_theme_options_settings;

   /**
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'cleanretina_style', get_stylesheet_uri() );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/**
	 * Register JQuery cycle js file for slider.
	 * Register Jquery fancybox js and css file for fancybox effect.
	 */
	wp_register_script( 'jquery_cycle', CLEANRETINA_JS_URL . '/jquery.cycle.all.min.js', array( 'jquery' ), '2.9999.5', true );
	wp_register_script( 'jquery_fancybox', CLEANRETINA_JS_URL . '/jquery.fancybox-1.3.4.pack.js', array('jquery'), '1.3.4', true );

   wp_register_style( 'jquery_fancybox_style', CLEANRETINA_CSS_URL . '/jquery.fancybox-1.3.4.css', true );
   wp_register_style( 'google_font_genttium_basic', 'http://fonts.googleapis.com/css?family=Gentium+Basic:400,400italic,700,700italic' );
    
	
	/**
	 * Enqueue Slider setup js file.
	 * Enqueue Fancy Box setup js and css file.	 
	 */	
	if( ( is_home() || is_front_page() ) && "0" == $options[ 'disable_slider' ] ) {
		wp_enqueue_script( 'cleanretina_slider', CLEANRETINA_JS_URL . '/cleanretina-slider-setting.js', array( 'jquery_cycle' ), false, true );
	}
	wp_enqueue_script( 'cleanretina_fancybox_setup', CLEANRETINA_JS_URL . '/cleanretina-custom-fancybox-script.js', array('jquery_fancybox'), false , true);
   wp_enqueue_script( 'tinynav', CLEANRETINA_JS_URL . '/tinynav.js', array( 'jquery' ) );
   wp_enqueue_script( 'backtotop', CLEANRETINA_JS_URL. '/backtotop.js', array( 'jquery' ) );

   wp_enqueue_style( 'jquery_fancybox_style' );
   wp_enqueue_style( 'google_font_genttium_basic' );

   /**
    * Browser specific queuing i.e
    */
	$cleanretina_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$cleanretina_user_agent)) {
		wp_enqueue_script( 'html5', CLEANRETINA_JS_URL . '/html5.js', true ); 
	}

} 

/****************************************************************************************/

add_filter( 'wp_page_menu', 'cleanretina_wp_page_menu' );
/**
 * Remove div from wp_page_menu() and replace with ul.
 * @uses wp_page_menu filter
 */
function cleanretina_wp_page_menu ( $page_markup ) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
	$divclass = $matches[1];
	$replace = array('<div class="'.$divclass.'">', '</div>');
	$new_markup = str_replace($replace, '', $page_markup);
	$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
	return $new_markup; 
}

/****************************************************************************************/

if ( ! function_exists( 'cleanretina_pass_cycle_parameters' ) ) :
/**
 * Function to pass the slider effectr parameters from php file to js file.
 */
function cleanretina_pass_cycle_parameters() {
    
    global $cleanretina_theme_options_settings;
    $options = $cleanretina_theme_options_settings;

    $transition_effect = $options[ 'transition_effect' ];
    $transition_delay = $options[ 'transition_delay' ] * 1000;
    $transition_duration = $options[ 'transition_duration' ] * 1000;
    wp_localize_script( 
        'cleanretina_slider',
        'cleanretina_slider_value',
        array(
            'transition_effect' => $transition_effect,
            'transition_delay' => $transition_delay,
            'transition_duration' => $transition_duration
        )
    );
    
}
endif;

/****************************************************************************************/

add_filter( 'excerpt_length', 'cleanretina_excerpt_length' );
/**
 * Sets the post excerpt length to 30 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function cleanretina_excerpt_length( $length ) {
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;

	return $options[ 'excerpt_length' ];
}

add_filter( 'excerpt_more', 'cleanretina_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function cleanretina_continue_reading() {
	return '&hellip; ';
}

/****************************************************************************************/

add_filter( 'body_class', 'cleanretina_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function cleanretina_body_class( $classes ) {
	global $post;	
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;

	if( $post ) {
		$layout = get_post_meta( $post->ID,'cleanretina_sidebarlayout', true ); 
	}
	if( ( empty( $layout ) || is_archive() || is_author() || is_search() ) && !is_home() ) {
		$layout = 'default';
	}
	elseif( is_home() ) {
		$layout = 'for_home';
	}
	if( 'default' == $layout ) {

		$themeoption_layout = $options[ 'default_layout' ];

		if( 'left-sidebar' == $themeoption_layout ) {
			$classes[] = 'left-sidebar-template';
		}
		elseif( 'right-sidebar' == $themeoption_layout  ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-full-width' == $themeoption_layout ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-one-column' == $themeoption_layout ) {
			$classes[] = 'one-column-template';
		}		
		elseif( 'no-sidebar' == $themeoption_layout ) {
			$classes[] = 'no-sidebar-template';
		}
	}	
   elseif( 'for_home' == $layout ) {
		$homepage_layout = $options[ 'home_page_layout' ];
		$blog_layout = $options[ 'blog_display_type' ];

		if( 'left-sidebar' == $homepage_layout ) {
			$classes[] = 'left-sidebar-template';
		}
		elseif( 'right-sidebar' == $homepage_layout ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-full-width' == $homepage_layout ) {
			$classes[] = '';
		}
		elseif( 'no-sidebar-one-column' == $homepage_layout ) {
			$classes[] = 'one-column-template';
		}
		elseif( 'no-sidebar' == $homepage_layout ) {
			$classes[] = 'no-sidebar-template';
		}
		elseif( 'corporate-layout' == $homepage_layout ) {
			$classes[] = '';
		}
		if( 'excerpt_display_two' == $blog_layout ) {
			$classes[] = 'blog-medium';
		}
   }
	elseif( 'left-sidebar' == $layout && !is_page_template( 'page-template-corporate.php' ) ) {
      $classes[] = 'left-sidebar-template';
   }
   elseif( 'right-sidebar' == $layout ) {
		$classes[] = '';
	}
	elseif( 'no-sidebar-full-width' == $layout ) {
		$classes[] = '';
	}
	elseif( 'no-sidebar-one-column' == $layout && !is_page_template( 'page-template-corporate.php' ) ) {
		$classes[] = 'one-column-template';
	}
	elseif( 'no-sidebar' == $layout && !is_page_template( 'page-template-corporate.php' ) ) {
		$classes[] = 'no-sidebar-template';
	}
   	

	return $classes;
}

/****************************************************************************************/

add_action( 'cleanretina_main_container', 'cleanretina_content', 10 );
/**
 * Function to display the content for the single post, single page, archive page, index page etc.
 */
function cleanretina_content() {
	global $post;	
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;
	if( $post ) {
		$layout = get_post_meta( $post->ID,'cleanretina_sidebarlayout', true );
	}
	if( ( empty( $layout ) || is_archive() || is_author() || is_search() ) && !is_home() ) {
		$layout = 'default';
	}
	elseif( is_home() ) {
		$layout = 'for_home';
	}
   if( 'default' == $layout ) {
		$themeoption_layout = $options[ 'default_layout' ];

		if( 'left-sidebar' == $themeoption_layout ) {
			get_template_part( 'content','leftsidebar' );
		}
		elseif( 'right-sidebar' == $themeoption_layout ) {
			get_template_part( 'content','rightsidebar' );
		}
		else {
			get_template_part( 'content','nosidebar' );
		}
   }
   elseif( 'for_home' == $layout ) {
		$homepage_layout = $options[ 'home_page_layout' ];

		if( 'left-sidebar' == $homepage_layout ) {
			get_template_part( 'content','leftsidebar' );
		}
		elseif( 'right-sidebar' == $homepage_layout ) {
			get_template_part( 'content','rightsidebar' );
		}
		elseif( 'corporate-layout' == $homepage_layout ) {
			get_template_part( 'content','corporate' );
		}
		else {
			get_template_part( 'content','nosidebar' );
		}
   }
   elseif( 'left-sidebar' == $layout ) {
      get_template_part( 'content','leftsidebar' );
   }
   elseif( 'right-sidebar' == $layout ) {
      get_template_part( 'content','rightsidebar' );
   }
   else {
      get_template_part( 'content','nosidebar' );
   }

}

/****************************************************************************************/

add_action( 'cleanretina_before_loop_content', 'cleanretina_loop_before', 10 );
/**
 * Contains the opening div
 */
function cleanretina_loop_before() {
	echo '<div id="content">';
}

add_action( 'cleanretina_loop_content', 'cleanretina_theloop', 10 );
/** Displays featured image caption **/
function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
  }
}
/**
 * Shows the loop content
 */
function cleanretina_theloop() {
	global $post;
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;

	if( have_posts() ) {
		while( have_posts() ) {
			the_post();

	do_action( 'cleanretina_before_post' );

	if( !is_page() ) {
	?>
   	<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   		<article class="clearfix">
   <?php 
	}
	?>
        		<?php do_action( 'cleanretina_before_post_header' ); ?>

        		<header class="entry-header">
            	<h2 class="entry-title">
            		<?php if( is_page() || is_single() ){
            			the_title();
            		} ?>
            	</h2>

        			<?php 
        			if( ( is_archive() || is_home() ) ) {
        			?>                        
            	<div class="entry-meta">
						
            	</div><!-- .entry-meta -->
        			<?php
        			}
        			?>
                    
                    <?php 
        			if( ( is_single() ) ) {
        			?>                        
            	<div class="entry-meta">
						<?php if($post->post_excerpt) { ?><span class="excerpt"> <?php the_excerpt(); ?></span><br /><?php } ?><span class="by-author"><?php _e( 'By', 'cleanretina' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
                	<span class="date">on <?php the_time( get_option( 'date_format' ) ); ?> in</span><?php if( has_category() ) { ?>
                		<span class="category">#<?php the_category(', '); ?></span> 
                	<?php } ?>
                	<!--
                	<?php if ( comments_open() ) { ?>
                		<span class="comments"><?php comments_popup_link( __( 'No Comments', 'cleanretina' ), __( '1 Comment', 'cleanretina' ), __( '% Comments', 'cleanretina' ), '', __( 'Comments Off', 'cleanretina' ) ); ?></span>-->
                	<?php } ?>
            	</div><!-- .entry-meta -->
        			<?php
        			}
        			?>
        		</header>

        		<?php do_action( 'cleanretina_after_post_header' ); ?>

        		<?php do_action( 'cleanretina_before_post_content' ); ?>

        		<?php
        		if( has_post_thumbnail() && ( is_archive() || is_home() ) ) {
        			$image = '';        			
        			$title_attribute = apply_filters( 'the_title', get_the_title( $post->ID ) );
        			if( 'excerpt_display_two' == $options[ 'blog_display_type' ] && is_home() ) {
	        			$image .= '<figure class="post-featured-image">';
	        			$image .= '<a href="' . get_permalink() . '" title="'.__( 'Permalink to ', 'cleanretina' ).the_title( '', '', false ).'">';
	        			$image .= get_the_post_thumbnail( $post->ID, 'featured-medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
	        			$image .= '</figure>';
        			}
        			elseif( ( 'excerpt_display_one' == $options[ 'blog_display_type' ] && is_home() ) || is_archive() ) {
        				$image .= '<figure class="post-featured-image"><a href="' . get_permalink() . '" title="'.the_title('','',false).'">';
						$image .= get_the_post_thumbnail( $post->ID, 'slider', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class'	=> 'pngfix' ) ).'</a></figure>';
        			}

        			echo $image;
        		}
        		?> 
                
            <?php if( is_archive() || is_home() ){ ?>
            		<?php if( has_category() ) { ?>
                		<p class="category-home">#<?php the_category(', '); ?></p> 
                	<?php } ?>
            		<h2 class="entry-title-home">
            			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
					</h2> 
			<?php } ?>
             
       		<?php if( 'excerpt_display_two' != $options[ 'blog_display_type' ] && is_home() ) { ?>
        		<div class="entry-content clearfix">
        		<?php } ?>
            <?php
            if( is_archive() || is_home() || is_search() ) {
            	if( is_home() && 'content_display' == $options[ 'blog_display_type' ] )	{ 
            		the_content( 'Read more' );
            	}
            	else {            		
                	echo '<span style="text-align:center;">';
                	the_excerpt();
					echo '</span>';
	            }
            }
            else {
				if( has_post_thumbnail() ) {
					the_post_thumbnail();
					echo '<em><span class="caption">';
					the_post_thumbnail_caption();
					echo '</span></em>';
				}
				echo '<br/><br/>';
               the_content();

               wp_link_pages( array( 
						'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'cleanretina' ),
						'after'             => '</div>',
						'link_before'       => '<span>',
						'link_after'        => '</span>',
						'pagelink'          => '%',
						'echo'              => 1 
               ) ); 

               if( is_single() ) {
						$tag_list = get_the_tag_list( '', __( ', ', 'cleanretina' ) );

						if( !empty( $tag_list ) ) {
							?>
							<div class="tags">
								<?php
								_e( 'Tagged: ', 'cleanretina' ); echo $tag_list;
								?>
							</div>
							<?php
						}
					}
            }
            ?>
            <?php if( 'excerpt_display_two' != $options[ 'blog_display_type' ] && is_home() ) { ?>
        		</div><!-- .entry-content -->  
        		<?php	} ?>

        		<?php do_action( 'cleanretina_after_post_content' );

            do_action( 'cleanretina_before_comments_template' ); 

            comments_template(); 

            do_action ( 'cleanretina_after_comments_template' );

	if( !is_page() ) { 
	?>
		  	</article>
		</section>
		<hr/>
	<?php
	}

   do_action( 'cleanretina_after_post' );

		}
	}
	else {
		?>
		<h1 class="entry-title"><?php _e( 'There is nothing here!', 'cleanretina' ); ?></h1>
      <p><?php _e( 'Try a new search.', 'cleanretina' ); ?></p>
      <?php
   }
}

add_action( 'cleanretina_after_loop_content', 'cleanretina_next_previous', 5 );
/**
 * Shows the next or previous posts
 */
function cleanretina_next_previous() {
	if( is_archive() || is_author() || is_home() || is_search() ) {
		/**
		 * Checking WP-PageNaviplugin exist
		 */
		if ( function_exists('wp_pagenavi' ) ) : 
			wp_pagenavi();

		else: 
			global $wp_query;
			if ( $wp_query->max_num_pages > 1 ) : 
			?>
			<ul class="default-wp-page clearfix">
				<li class="previous"><?php next_posts_link( __( '&laquo; Previous', 'cleanretina' ) ); ?></li>
				<li class="next"><?php previous_posts_link( __( 'Next &raquo;', 'cleanretina' ) ); ?></li>
			</ul>
			<?php
			endif;
		endif;
	}
}

add_action( 'cleanretina_after_post_content', 'cleanretina_next_previous_post_link', 10 );
/**
 * Shows the next or previous posts link with respective names.
 */
function cleanretina_next_previous_post_link() {
	if ( is_single() ) {
		if( is_attachment() ) {
		?>
			<ul class="default-wp-page clearfix">
				<li class="previous"><?php previous_image_link( false, __( '&larr; Previous', 'cleanretina' ) ); ?></li>
				<li class="next"><?php next_image_link( false, __( 'Next &rarr;', 'cleanretina' ) ); ?></li>
			</ul>
		<?php
		}
		else {
		?>
			<ul class="default-wp-page clearfix">
				<li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'cleanretina' ) . '</span> %title' ); ?></li>
				<li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'cleanretina' ) . '</span>' ); ?></li>
			</ul>
		<?php
		}
	}
}

add_action( 'cleanretina_after_loop_content', 'cleanretina_loop_after', 10 );
/**
 * Contains the closing div
 */
function cleanretina_loop_after() {
	echo '</div><!-- #content -->';
}

/****************************************************************************************/

add_action('wp_head', 'cleanretina_internal_css');
/**
 * Hooks the Custom Internal CSS to head section
 */
function cleanretina_internal_css() { 

	if ( ( !$cleanretina_internal_css = get_transient( 'cleanretina_internal_css' ) ) ) {

		global $cleanretina_theme_options_settings;
		$options = $cleanretina_theme_options_settings;

		if( !empty( $options[ 'custom_css' ] ) ) {
			$cleanretina_internal_css = '<!-- '.get_bloginfo('name').' Custom CSS Styles -->' . "\n";
			$cleanretina_internal_css .= '<style type="text/css" media="screen">' . "\n";
			$cleanretina_internal_css .=  $options['custom_css'] . "\n";
			$cleanretina_internal_css .= '</style>' . "\n";
		}

		set_transient( 'cleanretina_internal_css', $cleanretina_internal_css, 86940 );
	}
	echo $cleanretina_internal_css;
}

/****************************************************************************************/

add_action('wp_head', 'cleanretina_verification');
/**
 * Header Analytic Tools
 *
 * If user sets the code we're going to display meta verification
 */ 
function cleanretina_verification() {;    
    
	if ( ( !$cleanretina_verification = get_transient( 'cleanretina_verification' ) ) )  {

		global $cleanretina_theme_options_settings;
		$options = $cleanretina_theme_options_settings;

		$cleanretina_verification = '';

		// site stats, analytics header code
		if ( !empty( $options['analytic_header'] ) ) {
		$cleanretina_verification .=  $options[ 'analytic_header' ] ;
		}

		set_transient( 'cleanretina_verification', $cleanretina_verification, 86940 );    
	}
	echo $cleanretina_verification;
}

/****************************************************************************************/

add_action('wp_footer', 'cleanretina_footercode');
/**
 * Footer Analytics Code
 */
function cleanretina_footercode() { 
    
   $cleanretina_footercode = '';
	if ( ( !$cleanretina_footercode = get_transient( 'cleanretina_footercode' ) )  ) {

		global $cleanretina_theme_options_settings;
		$options = $cleanretina_theme_options_settings;

		// site stats, analytics footer code
		if ( !empty( $options['analytic_footer'] ) ) {  
		$cleanretina_footercode .=  $options[ 'analytic_footer' ] ;
		}

		set_transient( 'cleanretina_footercode', $cleanretina_footercode, 86940 );
	}
	echo $cleanretina_footercode;
}

/****************************************************************************************/

add_action( 'cleanretina_home_corporate_content', 'cleanretina_display_home_corporate_content', 10 );
/**
 * Function to display the content for home page corporate type layout
 */
function cleanretina_display_home_corporate_content() {
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;
?>
	<div id="content">
		<?php
    	
    	$cleanretina_display_home_corporate_content = '';
		if ( ( !$cleanretina_display_home_corporate_content = get_transient( 'cleanretina_display_home_corporate_content' ) )  ) {			
			if( !empty( $options[ 'corporate_content_title' ] ) ) {
				$cleanretina_display_home_corporate_content .= '<h1 class="entry-title">' . $options[ 'corporate_content_title' ] . '</h1>';
			}
			if( !empty( $options[ 'featured_home_box_image' ] ) || !empty( $options[ 'featured_home_box_title' ] ) || !empty( $options[ 'featured_home_box_description' ] ) ) {
				$cleanretina_display_home_corporate_content .= 
				'<div class="services clearfix">';

					for( $i = 1; $i <= 3; $i++ ) {
						if( !empty( $options[ 'featured_home_box_image' ][ $i ] ) || !empty( $options[ 'featured_home_box_title' ][ $i ] ) || !empty( $options[ 'featured_home_box_description' ][ $i ] ) ) {
							$cleanretina_display_home_corporate_content .= 
							'<div class="services-item">';
								if( !empty( $options[ 'featured_home_box_link' ][ $i ] ) ) {
									$cleanretina_display_home_corporate_content .= '<a href="'. esc_url( $options[ 'featured_home_box_link' ][ $i ] ) . '" title="' . esc_attr( $options[ 'featured_home_box_title' ][ $i ] ) . '">';
								}
								else {
									$cleanretina_display_home_corporate_content .= '<a href="#" title="' . esc_attr( $options[ 'featured_home_box_title' ][ $i ] ) . '">';
								}
								if( !empty( $options[ 'featured_home_box_image' ][ $i ] ) ) {								
									$cleanretina_display_home_corporate_content .= 
										'<span class="service-icon">
										<img src="' . esc_url( $options[ 'featured_home_box_image' ][ $i ] ) . '" alt="' .esc_attr( $options[ 'featured_home_box_title' ][ $i ] ) . '">
										</span>';
								}
								if( !empty( $options[ 'featured_home_box_title' ][ $i ] ) ) {
									$cleanretina_display_home_corporate_content .= '<h2 class="service-title">' . $options[ 'featured_home_box_title' ][ $i ] . '</h2>';
								}
								if( !empty( $options[ 'featured_home_box_description' ][ $i ] ) ) {
									$cleanretina_display_home_corporate_content .= '<p>' . $options[ 'featured_home_box_description' ][ $i ] . '</p>';
								}
									
								$cleanretina_display_home_corporate_content .= '</a>';
								
							$cleanretina_display_home_corporate_content .= 
							'</div>';
						}
					}	
				$cleanretina_display_home_corporate_content .= 			
				'</div>';
			}

			set_transient( 'cleanretina_display_home_corporate_content', $cleanretina_display_home_corporate_content, 86940 );
		}
		echo $cleanretina_display_home_corporate_content;
		?>
	</div><!-- #content -->
<?php
}

/****************************************************************************************/

add_action('template_redirect', 'cleanretina_feed_redirect');
/**
 * Redirect WordPress Feeds To FeedBurner
 */
function cleanretina_feed_redirect() {
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;

	if ( !empty( $options['feed_url'] ) ) {
		$url = 'Location: '.$options['feed_url'];
		if ( is_feed() && !preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT'])) {
			header($url);
			header('HTTP/1.1 302 Temporary Redirect');
		}
	}
}

/****************************************************************************************/

if ( ! function_exists( 'cleanretina_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own cleanretina_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Clean Retina 1.0
 */
function cleanretina_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'cleanretina' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'cleanretina' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'cleanretina' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'cleanretina' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cleanretina' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'cleanretina' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'cleanretina' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/****************************************************************************************/

add_action( 'cleanretina_404_content', 'cleanretina_display_404_page_content', 10 );
/**
 * Function to show the content for 404 page.
 */
function cleanretina_display_404_page_content() {
?>
	<div id="content">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Four-oh-four !', 'cleanretina' ); ?></a></h1>
		</header>
		<div class="entry-content clearfix" >
			<p><?php _e( 'It seems we can\'t find what you\'re looking for.', 'cleanretina' ); ?></p>
			<h3><?php _e( 'This might be because:', 'cleanretina' ); ?></h3>
			<p><?php _e( 'You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.', 'cleanretina' ); ?></p>
			<h3><?php _e( 'Please try the following instead:', 'cleanretina' ); ?></h3>
			<p><?php _e( 'Check for a mis-typed URL error, then press the refresh button on your browser.', 'cleanretina' ); ?></p> 
		</div><!-- .entry-content -->
	</div><!-- #content -->
<?php
}

/****************************************************************************************/

add_action( 'pre_get_posts','cleanretina_alter_home' );
/**
 * Alter the query for the main loop in home page
 *
 * @uses pre_get_posts hook
 */
function cleanretina_alter_home( $query ){
	global $cleanretina_theme_options_settings;
	$options = $cleanretina_theme_options_settings;
	$cats = $options[ 'front_page_category' ];

	if ( $options[ 'exclude_slider_post'] != "0" && !empty( $options[ 'featured_post_slider' ] ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $options[ 'featured_post_slider' ];
		}
	}

	if ( !in_array( '0', $cats ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] = $options[ 'front_page_category' ];
		}
	}
}

/****************************************************************************************/

add_filter( 'wp_nav_menu_items', 'cleanretina_nav_menu_alter', 10, 2 );
/**
*Add default navigation menu to nav menu
* Used while viewing on smaller screen
*/
if ( !function_exists('cleanretina_nav_menu_alter') ) {
	function cleanretina_nav_menu_alter( $items, $args ) {
		$items .= '<li class="default-menu"><a href="'.get_bloginfo('url').'" title="Navigation">'.__( 'Navigation','cleanretina' ).'</a></li>';
		return $items;
	}
}

/****************************************************************************************/

add_filter( 'wp_list_pages', 'cleanretina_page_menu_alter' );
/**
 * Add default navigation menu to page menu
 * Used while viewing on smaller screen
 */
if ( !function_exists('cleanretina_page_menu_alter') ) {
	function cleanretina_page_menu_alter( $output ) {
		$output .= '<li class="default-menu"><a href="'.get_bloginfo('url').'" title="Navigation">'.__( 'Navigation','cleanretina' ).'</a></li>';
		return $output;
	}
}

/****************************************************************************************/

add_filter('wp_page_menu', 'cleanretina_wp_page_menu_filter');
/**
 * @uses wp_page_menu filter hook
 */
if ( !function_exists('cleanretina_wp_page_menu_filter') ) {
	function cleanretina_wp_page_menu_filter( $text ) {
		$replace = array(
			'current_page_item'     => 'current-menu-item'
	 	);

	  $text = str_replace(array_keys($replace), $replace, $text);
	  return $text;
	}
}

/**************************************************************************************/

?>