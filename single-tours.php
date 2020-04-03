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
        <div><strong>Duration</strong> - <?php display_duration(); ?></div>
        <div><strong>Type of tour</strong> - <?php display_tour_type();  ?></div>
        <div><strong>Start point</strong> - <?php display_start_point(); ?></div>
        <div><strong>Finish point</strong> - <?php display_end_point(); ?></div>
        <div><strong>Tour price</strong> - Starts at <?php display_tour_price(); ?></div>
    </div>
    
    <?php
}       





function display_duration() { 
    $duration = get_field('duration');

    if( $duration ) { 
    	echo $duration; 
    }
}

function display_tour_type() { 
    $tour_type = get_field('tour_type');

    if( $tour_type ) { 
        echo $tour_type; 
    }
}

function display_start_point() { 
    $start_point = get_field('start_point');

    if( $start_point ) { 
        echo $start_point; 
    }
}

function display_end_point() { 
    $end_point = get_field('end_point');

    if( $end_point ) { 
        echo $end_point; 
    }
}

function display_tour_price() { 
    $tour_price = get_field('tour_price');

    if( $tour_price ) { 
    	echo $tour_price; 
    }
}


genesis();