<?php
/**
 * Implements a custom header for Clean Retina.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */

add_action( 'after_setup_theme', 'cleanretina_custom_header_setup' );
/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses cleanretina_header_style() to style front-end.
 * @uses cleanretina_admin_header_style() to style wp-admin form.
 * @uses cleanretina_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since Clean Retina 1.0
 */
function cleanretina_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '555555',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => apply_filters( 'cleanretina_header_image_height', 250 ),
		'width'                  => apply_filters( 'cleanretina_header_image_width', 978 ),
		'max-width'              => 2000,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'cleanretina_header_style',
		'admin-head-callback'    => 'cleanretina_admin_header_style',
		'admin-preview-callback' => 'cleanretina_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}

/**
 * Styles the header text displayed on the blog.
 *
 * get_header_textcolor() options: 555555 is default, hide text (returns 'blank'), or any hex value.
 *
 * @since Clean Retina 1.0
 */
function cleanretina_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		#site-logo {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Clean Retina 1.0
 */
function cleanretina_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#headimg h2 {
		line-height: 1.6;
		margin: 0;
		padding: 0;
	}
	#headimg h1 {
		font-size: 30px;
	}
	#headimg h1 a {
		color: #515151;
		text-decoration: none;
		font: 42px/50px 'Gentium Basic',serif;
	}
	#headimg h1 a:hover {
		color: #21759b;
	}
	#headimg h2 {
		color: #888888;
		font-size: 16px;
		font-family: 'Gentium Basic',serif;
		margin-bottom: 24px;
	}
	#headimg img {
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
	}
	</style>
<?php
}

/**
 * Outputs markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 *
 * @since Clean Retina 1.0
 */
function cleanretina_admin_header_image() {
	?>
	<div id="headimg">		
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }