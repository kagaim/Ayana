<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Ayana
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function kgm_ayana_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'kgm_ayana_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function kgm_ayana_jetpack_setup
add_action( 'after_setup_theme', 'kgm_ayana_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function kgm_ayana_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function kgm_ayana_infinite_scroll_render
