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
	return 'jp' === get_user_locale( $user_id );
}
