<?php
/**
 * Navigation
 *
 * @package 	EdinburghUnwrapped
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
 */

// Primary Nav in Header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 11 );

// Secondary Nav in Footer.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 8 );

add_filter( 'wp_nav_menu_args', 'eduw_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function eduw_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}


/**
 * Add top bar
 *
 */
add_action( 'genesis_header', 'is_top_bar', 9 );
function is_top_bar() { ?>

	<div class="top-bar clearfix">
		<div class="wrap">
			<div class="top-left"><?php is_contact_links(); ?></div>
			<div class="top-right"><?php is_social_links(); ?></div>
		</div>
	</div>

	<div class="wrap"><?php
}

add_action( 'genesis_header', 'is_header_wrap_close', 12 );
function is_header_wrap_close() { ?>
	</div><?php
}

function is_social_links() {
	if (have_rows('social_media', 'option')) {
		echo '<ul class="social">';
        while (have_rows('social_media', 'option')) : the_row(); 
        	$social_url = get_sub_field('url');
        	$service = get_sub_field('service');

        	?>
        	<li><a href="<?php echo $social_url; ?>" title="<?php echo $service['label']; ?>"><?php echo $service['value']; ?></a></li>
        <?php
        endwhile;
        echo '</ul>';
    }
}

function is_contact_links() {
	if (get_field('company_phone', 'options')) { ?>
		<div class="phone"><i class="fas fa-phone"></i> <a href="tel:44<?php echo the_field('company_phone', 'options'); ?>">+44 <?php echo the_field('company_phone', 'options'); ?></a></div>
		<?php
	}
	if (get_field('contact_email', 'options')) { ?>
		<div class="email"><i class="fas fa-at"></i> <a href="mailto:<?php echo the_field('contact_email', 'options'); ?>"><?php echo the_field('contact_email', 'options'); ?></a></div>
		<?php
	}
}



// Responsive menu

/**
 * Defines responsive menu settings.
 *
 * @since 1.0.0
 */
function responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( '<span class="hamburger-box"><span class="hamburger-inner"></span></span>' ),
		'menuIconClass'    => 'hamburger hamburger--elastic',
		'subMenu'          => __( 'Submenu', CHILD_TEXT_DOMAIN ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}