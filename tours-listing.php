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


add_action( 'genesis_after_content', 'eduw_trips_by_category_loop', 1 );
function eduw_trips_by_category_loop() {

    $tour_type = get_field('tour_type');

    if ( $tour_type ) {
        $args = (array(
            'post_type'      => 'tours',
            'posts_per_page' => -1,
            'no_found_rows' => true,
            'tax_query' => array(
                array(
                    'taxonomy' => 'tour-type',
                    'field'    => 'term_id',
                    'terms'    => $tour_type,
                ),
            ),
            'orderby'   => 'menu_order',
            'order'     => 'ASC',
        )); 
    } else {
        $args = (array(
            'post_type'      => 'tours',
            'posts_per_page' => -1,
            'no_found_rows' => true,
            'orderby'   => 'menu_order',
            'order'     => 'ASC',
        )); 
    }

    ?>

    <div class="available-tours">
        <div class="wrap">
            <?php genesis_custom_loop( $args ); ?>
        </div>
    </div>

    <?php
}

genesis();