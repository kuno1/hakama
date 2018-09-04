<?php
/**
 * Setting for theme.
 *
 *
 * @package hakama
 */


/**
 * Register supports.
 */
add_action( 'after_setup_theme', function() {
	
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 128,
		'flex-width'  => true,
	) );
	
	add_theme_support( 'html5', [
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	] );
	
	add_theme_support( 'woocommerce' );

} );

// Hide admin bar.
add_filter( 'show_admin_bar', '__return_false' );

