<?php

/**
 * Tour Page Link Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tour-link-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'tour-link';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$tour_link = get_field('tour_link');
if( $tour_link ): 
    $permalink = get_permalink( $tour_link->ID );
    $image = get_the_post_thumbnail( $tour_link->ID, 'eduw_featured' );
    $title = $tour_link->post_title;
    $excerpt = $tour_link->post_excerpt;
    ?>
    <div class="tour-link">
        <a href="<?php echo esc_url( $permalink ); ?>"><?php echo $image; ?></a>
        <h2><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h2>
        <p class="tour-excerpt"><?php echo esc_html( $excerpt ); ?></p>
        <a href="<?php echo esc_url( $permalink ); ?>"class="more-link button">Read More</a>
    </div>
<?php endif;