<?php
/**
 * Comment related hooks
 *
 * @package hakama
 */

add_filter( 'hamethread_dynamic_comment_post_types', function( $post_types ) {
	$post_types[] = 'faq';
	return $post_types;
} );
