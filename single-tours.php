<?php
/**
 * Tours single post
 *
 * @package 	EdinburghUnwrapped
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

/**
 * Add hero block
 *
 */
add_action( 'genesis_after_header', 'eduw_tour_title_hero', 10 );
function eduw_tour_title_hero() {

    if ( !has_post_thumbnail() ) { ?>
        <div class="tour-hero no-hero"></div>
        <?php
    }

    else { ?>
        <div class="tour-hero">
            <?php the_post_thumbnail('hero'); ?>
            <div class="hero-overlay">
                <div class="wrap">
                    <?php genesis_do_post_title(); ?>
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
        
        <?php
    }       
}


/**
 * Add quick details
 *
 */
add_action( 'genesis_before_entry', 'eduw_tour_quick_details', 5 );
function eduw_tour_quick_details() { ?>

    <div class="tour-details">
        <div><strong>Tour name</strong> - <?php echo esc_html( get_the_title() ); ?></div>
        <?php display_duration(); ?>
        <?php display_tour_type();  ?>
        <?php display_start_point(); ?>
        <?php display_end_point(); ?>
        <?php display_tour_price(); ?>
    </div>
    
    <?php
}       





function display_duration() { 
    $duration = get_field('duration');

    if( $duration ) { ?>
        <div><strong>Duration</strong> - <?php echo $duration; ?></div>
    <?php }
}

function display_tour_type() { 
    $tour_type = get_field('tour_type');

    if( $tour_type ) { ?>
        <div><strong>Type of tour</strong> - <?php echo $tour_type; ?></div>
    <?php }
}

function display_start_point() { 
    $start_point = get_field('start_point');

    if( $start_point ) { ?>
        <div><strong>Start point</strong> - <?php echo $start_point; ?></div>
    <?php }
}

function display_end_point() { 
    $end_point = get_field('end_point');


    if( $end_point ) { ?>
        <div><strong>End point</strong> - <?php echo $end_point; ?></div>
    <?php }
}

function display_tour_price() { 
    $tour_price = get_field('tour_price');

    if( $tour_price ) { ?>
        <div><strong>Tour price</strong> - <?php echo $tour_price; ?></div>
    <?php }
}


genesis();