<?php

// Add opening div.articles tag before the latest post.
add_action( 'genesis_before_entry', function () {
    global $wp_query;

    if ( 0 === $wp_query->current_post && is_main_query() ) {
        echo '<div class="articles-grid">';
    }
} );

// Move .archive-pagination from under main.content to adjacent to it.
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_content', 'genesis_posts_nav' );

// Add closing div tag (for .articles) after the last post.
add_action( 'genesis_after_endwhile', function () {
    if ( is_main_query() ) {
        echo '</div>';
    }
} );