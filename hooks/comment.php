<?php
/**
 * Comment related hooks
 *
 * @package hakama
 */

// Add post types.
add_filter( 'hamethread_dynamic_comment_post_types', function( $post_types ) {
	$post_types[] = 'faq';
	$post_types[] = 'post';
	return $post_types;
} );

// Change labels.
add_filter( 'gettext', function( $translation, $text, $domain ) {
	if ( 'hamethread' !== $domain ) {
		return $translation;
	}
	switch ( $text ) {
		case 'e.g. What does "dark matter" mean?':
			$translation = __( 'e.g. Let me know how to use this plugin.', 'hakama' );
			break;
		case 'e.g. Yesterday, I read an article about galaxy. But I can\'t understand nor even imagine what "dark matter" is. Please ask my question.':
			$translation = __( 'e.g. Today, I bought this plugin. Would you let me know how to install and how to use it?', 'hakama' );
			break;
	}
	return $translation;
}, 10, 3 );

// Remove hamethread css.
add_action( 'init', function() {
	wp_deregister_style( 'hamethread' );
}, 21 );
