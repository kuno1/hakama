<?php
/**
 * Conditional functions
 *
 * @package hakama
 */

/**
 * Check if woocommerce exists.
 *
 * @return bool
 */
function hakama_has_woo() {
	return function_exists( 'WC' ) && WC();
}

/**
 * Return parent product ID if exists.
 *
 * @return int
 */
function hakama_document_parent() {
	if ( is_singular() ) {
		return get_queried_object()->post_parent;
	} else {
		return (int) get_query_var( 'post_parent' );
	}
}

/**
 * Detect if user is japanese speaker.
 *
 * @param int $user_id
 * @return bool
 */
function hakama_is_jp( $user_id = 0 ) {
	return 'ja' === get_user_locale( $user_id );
}

/**
 * Detect if post author is admin.
 *
 * @param null|int|WP_Post $post
 * @return bool
 */
function hakama_author_is_admin( $post = null ) {
	$post = get_post( $post );
	return user_can( $post->post_author, 'edit_others_posts' );
}
