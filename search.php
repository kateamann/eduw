<?php


add_action( 'genesis_before_loop', 'eduw_do_search_title' );
/**
 * Echo the title with the search term.
 *
 * @since 1.9.0
 */
function eduw_do_search_title() {

    $title = sprintf( '<div class="archive-description"><h1 class="archive-title">%s %s</h1></div>', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', 'genesis' ) ), get_search_query() );

    echo apply_filters( 'genesis_search_title_output', $title ) . "\n";

}


get_template_part( 'loop', 'archive' );

genesis();