<?php

/**
 * Template Name: Tours Listing
 *
 * @package 	EdinburghUnwrapped
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
 *
 */

add_action( 'genesis_before_loop', 'genesis_entry_header_markup_open', 11 );
add_action( 'genesis_before_loop', 'genesis_do_post_title', 12 );
add_action( 'genesis_before_loop', 'genesis_entry_header_markup_close', 13 );



/** Replace the standard loop with people loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'eduw_trips_loop' );
 
function eduw_trips_loop() {

    $tours_intro = get_field('tours_intro');

    if ( $tours_intro ) {
        echo '<div class="intro-text">';
        echo $tours_intro;
        echo '</div>';
    }

	//Protect against arbitrary paged values
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
 
    global $query_args; // grab the current wp_query() args
    $args = array(
        'post_type' => 'tours',
        'posts_per_page' => get_option( 'posts_per_page' ),
		'post_status'    => 'publish',
        'paged'            => $paged
    );
 
    genesis_custom_loop( wp_parse_args($query_args, $args) );
 	wp_reset_query();
}

genesis();