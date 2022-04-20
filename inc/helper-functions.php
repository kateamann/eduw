<?php
/**
 * Helper Functions
 *
 * @package     EdinburghUnwrapped
 * @author      Kate Amann
 * @since       1.0.0
 * @license     GPL-2.0+
 */


/**
 * Adds Tour Link block
 */
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'tour-link',
            'title'             => __('Tour Link'),
            'description'       => __('A tour link block.'),
            'render_template'   => 'inc/blocks/tour-link.php',
            'category'          => 'formatting',
            'icon'              => 'dashicons dashicons-tickets-alt',
            'keywords'          => array( 'tour', 'link' ),
        ));
    }
}


/**
 * Adds company data admin page 
 * `options_page` is going to be the name of ACF group we use to set up the fields
 *  
 * @url https://github.com/PascalAOMS/wp-acf-schema-template
 * 
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'theme-options',
        'capability' => 'edit_posts',
        'redirect'   => false
    ));
}


/**
 * Move Yoast to the Bottom
 */
function yoast_to_bottom() {
  return 'low';
}
//add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom');


