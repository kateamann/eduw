<?php
/**
 * Front Page
 *
 * @package 	EdinburghUnwrapped
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/

add_action( 'wp_enqueue_scripts', 'eduw_enqueue_slick' );
wp_enqueue_script( 'home-slider-init', get_stylesheet_directory_uri() . "/js/slick-home.js", array( 'slider' ), CHILD_THEME_VERSION, true );

add_action( 'genesis_after_header', 'eduw_home_hero', 10 );
function eduw_home_hero() { 
	if( have_rows('home_slides') ) { ?>

	<div class="home-hero">
		<div class="home-slides">

		<?php while( have_rows('home_slides') ): the_row(); 

			$image = get_sub_field('image');
			$size = 'hero';
			$thumb = $image['sizes'][ $size ];
			$width = $image['sizes'][ $size . '-width' ];
			$height = $image['sizes'][ $size . '-height' ];

			$heading = get_sub_field('heading');
			$caption = get_sub_field('caption');
			$link = get_sub_field('link');

			?>

			<a class="home-slide" href="<?php echo $link; ?>" title="">

				<img class="hero-image" src="<?php echo $thumb; ?>" alt="<?php echo $image['alt'] ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

				<div class="hero-overlay">
					<div class="wrap">
					<h2><?php echo $heading; ?></h2>
					<p><?php echo $caption; ?></p>
					</div>
				</div>

			</a><?php 

			endwhile; ?>
		</div>
	</div>

<?php }
}


add_action( 'genesis_after_header', 'eduw_home_strapline', 11 );
function eduw_home_strapline() { 
	if( get_field('strapline') ) { ?>

	<div class="home-strapline">
		<div class="wrap">

		<?php the_field('strapline'); ?> 

		</div>
	</div>

<?php }
}

function eduw_set_custom_entry_title_wrap( $wrap ) {
	$wrap = 'h3';
	return $wrap;
}

add_action( 'genesis_before_footer', 'eduw_featured_tours_loop', 1 );
function eduw_featured_tours_loop() {

	$ids = get_field('featured_tours', 'option', false, false);

	$args = (array(
		'post_type'      => 'tours',
		'posts_per_page' => 3,
		'no_found_rows' => true,
		'post__in' => $ids,
		'order'     => 'ASC',
	)); 

	add_filter( 'genesis_entry_title_wrap', 'eduw_set_custom_entry_title_wrap' );
	add_action( 'genesis_entry_footer', 'eduw_custom_add_read_more', 10 );
	?>

	<div class="featured-tours">
		<div class="wrap">
			<h2>Featured Tours</h2>
			<?php genesis_custom_loop( $args ); ?>
		</div>
	</div>

	<?php
	remove_filter( 'genesis_entry_title_wrap', 'eduw_set_custom_entry_title_wrap' );
	remove_action( 'genesis_entry_footer', 'eduw_custom_add_read_more', 10 );
}


add_action( 'genesis_before_footer', 'eduw_latest_posts_loop', 2 );
function eduw_latest_posts_loop() {

	$args = (array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'no_found_rows' => true
	)); 

	add_filter( 'genesis_entry_title_wrap', 'eduw_set_custom_entry_title_wrap' );
	?>

	<div class="latest-posts">
		<div class="wrap">
			<h2>Latest Posts</h2>
			<?php genesis_custom_loop( $args ); ?>
		</div>
	</div>

	<?php
	remove_filter( 'genesis_entry_title_wrap', 'eduw_set_custom_entry_title_wrap' );
}

genesis();