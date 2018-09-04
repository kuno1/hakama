<?php
/**
 * Menu related functions.
 *
 * @package hakama
 */

// Register menus
add_action( 'after_setup_theme', function() {
	register_nav_menus( [
		'global_menu' => _x( 'Global menu.', 'admin', 'hakama' ),
	] );
} );

/**
 * Add body class
 */
add_filter( 'body_class', function( $classes ) {
	$classes[] = 'with-header-nav';
	return $classes;
} );
