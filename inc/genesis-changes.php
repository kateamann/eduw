<?php
/**
 * Genesis Changes
 *
 * @package 	EdinburghUnwrapped
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
 */

// Theme Supports
add_theme_support( 'html5', array( 
	'search-form', 
	'comment-form', 
	'comment-list', 
	'gallery', 
	'caption' 
) );

add_theme_support( 'genesis-responsive-viewport' );

add_theme_support( 'genesis-footer-widgets', 2 );

add_theme_support( 'genesis-structural-wraps', array(  
	'menu-secondary', 
	'site-inner', 
	'footer-widgets', 
	'footer' 
) );

add_theme_support( 'genesis-menus', array( 
	'primary' => 'Primary Navigation Menu', 
	'secondary' => 'Secondary Navigation Menu', 
) );

// Adds support for accessibility.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
//	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
	'screen-reader-text',
) );

// Enable the block-based widget editor
add_filter( 'use_widgets_block_editor', '__return_true' );

// Enable excerpts on pages
add_post_type_support( 'page', 'excerpt' );

// Remove Genesis Layout Settings
remove_theme_support( 'genesis-inpost-layouts' );

// Remove Genesis Scripts Settings
add_action( 'admin_menu' , 'remove_genesis_page_post_scripts_box' );
function remove_genesis_page_post_scripts_box() {

	$types = array( 'post','page' );

	remove_meta_box( 'genesis_inpost_scripts_box', $types, 'normal' ); 
}

//* Remove Genesis in-post SEO Settings
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );

// Remove Edit link
add_filter( 'genesis_edit_post_link', '__return_false' );

// Remove Genesis Favicon (use site icon instead)
remove_action( 'wp_head', 'genesis_load_favicon' );

// Remove Header Description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove sidebar layouts
unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

add_filter( 'genesis_pre_get_option_site_layout', 'custom_set_single_posts_layout' );
/**
 * Apply Content Sidebar content layout to single posts.
 * 
 * @return string layout ID.
 */
function custom_set_single_posts_layout() {
    if ( is_singular( 'post' ) ) {
        return 'content-sidebar';
    }
}


// Custom sidebars
genesis_register_sidebar( 
	array( 
		'id' => 'blog-sidebar', 
		'name' => 'Blog Sidebar'
	) 
);

/**
 * Display Blog Sidebar
 * 
 */
function eduw_blog_sidebar() {
	if( is_singular( 'post' ) ) {
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		dynamic_sidebar( 'blog-sidebar' );
	}
}
add_action( 'genesis_sidebar', 'eduw_blog_sidebar', 6 );



add_action( 'genesis_before_entry', 'eduw_featured_image' );
/**
 * Display featured image (if present) before entry on single Posts
 */
function eduw_featured_image() {
    // if we are not on a single Post having a featured image, abort.
    if ( ! ( is_singular( 'post' ) && has_post_thumbnail() ) ) {
        return;
    }

    // get the URL of featured image.
    $image = genesis_get_image( 'format=url&size=eduw_featured' );

    // get the alt text of featured image.
    $thumb_id = get_post_thumbnail_id( get_the_ID() );
    $alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );

    // if no alt text is present for featured image, set it to Post title.
    if ( '' === $alt ) {
        $alt = the_title_attribute( 'echo=0' );
    }

    // get the caption of featured image.
    $caption = get_post( $thumb_id )->post_excerpt;

    // build the caption HTML if caption is present for the featured image..
    $caption_html = $caption ? '<figcaption class="wp-caption-text">'. $caption . '</figcaption>' : '';

    // display the featured image with caption (if present) beneath the image.
    printf( '<figure class="single-post-image wp-caption"><img src="%s" alt="%s" />%s</figure>', esc_url( $image ), $alt, $caption_html );
}



// Archive layouts
add_action( 'genesis_header', 'is_post_layout' );
function is_post_layout() {
	if ( !is_single() ) {
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		add_action( 'genesis_entry_header', 'genesis_do_post_image', 5 );
		add_action( 'genesis_entry_content', 'is_archive_trip_type', 10 );
	}
}

function is_archive_trip_type() { ?>
    <p class="tour-meta"><?php the_terms( $post->ID, 'tour-type', 'Trip type: ', ', ', ' ' );?> </p>
    <?php
}


/**
 * Add Read More button below post excerpts/content on archives.
 */
function eduw_custom_add_read_more() {
    if ( is_singular() ) {
        return;
    }

    printf( '<a href="%s" class="more-link button">%s</a>', get_permalink(), esc_html__( 'Read More' ) );
}

//* Modify the length of post excerpts
add_filter( 'excerpt_length', 'sp_excerpt_length' );
function sp_excerpt_length( $length ) {
	return 20; // pull first 50 words
}

/**
 * Remove Genesis Templates
 *
 */
function eduw_remove_genesis_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'eduw_remove_genesis_templates' );