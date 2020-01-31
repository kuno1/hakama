<?php
/**
 * Block related functions.
 *
 * @package hakama
 */

/**
 * Enable block library
 */
add_action( 'after_setup_theme', function() {
	if ( class_exists( 'Kunoichi\BlockLibrary' ) ) {
		\Kunoichi\BlockLibrary::enable();
	}
} );

/**
 * Add templates for post list.
 */
add_filter( 'kbl_post_list_templates', function( $templates ) {
	return array_merge( $templates, [
		'card' => __( 'Card List', 'hakama' ),
	] );
} );

/**
 * Change Post list pre
 */
add_filter( 'kbl_post_list_pre', function( $pre, $attributes ) {
	switch ( $attributes[ 'template' ] ) {
		case '':
		case 'default':
			return '<ul class="post-list">';
		default:
			return $pre;
	}
}, 10, 2 );

/**
 * Change Post list after
 */
add_filter( 'kbl_post_list_after', function( $after, $attributes ) {
	switch ( $attributes[ 'template' ] ) {
		case '':
		case 'default':
			return '</ul>';
		default:
			return $after;
	}
}, 10, 2 );
