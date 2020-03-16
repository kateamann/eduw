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

genesis();