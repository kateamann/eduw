<?php
/**
 * Custom Logo
 *
 * @package     EdinburghUnwrapped
 * @author      Kate Amann
 * @since       1.0.0
 * @license     GPL-2.0+
**/

// Adds custom logo in Customizer > Site Identity.
add_theme_support(
	'custom-logo', array(
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	)
);

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

/**
 * Customizer CSS
 * @see https://gist.github.com/billerickson/2c9a311dfd0d346cffbdfa448eacc924
 */
function eduw_customizer_css() {

	$css = false;

	$logo = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
	if ( $logo ) {

		$css .= '
		.wp-custom-logo .site-title a {
			background-image: url(' . $logo . ');
		}
		';
	}

	if( $css ) {
		wp_add_inline_style( 'eduw-style', $css );
	}

}
add_action( 'wp_enqueue_scripts', 'eduw_customizer_css' );
