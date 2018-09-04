<?php
/**
 * Thread related hoooks
 *
 * @package hakama
 */


/**
 * Add rewrite rules
 *
 * @return array
 */
add_filter( 'rewrite_rules_array', function( $rules ) {
	return array_merge( [
		'support/(\d+)/in/([^/]+)/page/(\d+)/?$' => 'index.php?post_type=thread&post_parent=$matches[1]&topic=$matches[2]&paged=$matches[3]',
		'support/(\d+)/in/([^/]+)/?$' => 'index.php?post_type=thread&post_parent=$matches[1]&topic=$matches[2]',
		'support/(\d+)/page/(\d+)/?$' => 'index.php?post_type=thread&post_parent=$matches[1]&paged=$matches[2]',
		'support/(\d+)/?$' => 'index.php?post_type=thread&post_parent=$matches[1]',
	], $rules );
} );


