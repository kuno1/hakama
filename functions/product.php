<?php
/**
 * Product related functions
 *
 * @package hakama
 */

/**
 * @param null|int|WP_Post $post
 * @param null|string|int|WP_Term $topic
 *
 * @return string
 */
function hakama_support_page( $post = null, $topic = null ) {
	return hakama_child_url( $post, $topic, 'topic', 'support/%d' );
}

/**
 * Get docunentation URL
 *
 * @param null|int|WP_Post $post
 * @param null|string|int|WP_Term $topic
 *
 * @return string
 */
function hakama_documentation_url( $post = null, $cat = null ) {
	return hakama_child_url( $post, $cat, 'faq_cat', 'faq/of/%d' );
}

/**
 * Get child URL
 *
 * @param null|int|WP_Post          $post
 * @param int|string|object|WP_Term $term
 * @param string                    $taxonomy
 * @param string $single_url
 * @param string $child_suffix
 *
 * @return string
 */
function hakama_child_url( $post = null, $term = null, $taxonomy = '', $single_url = '', $child_suffix = 'in/%s' ) {
	$post = get_post( $post );
	if ( ! $post ) {
		return home_url();
	}
	if ( ! $single_url ) {
		$single_url = "{$post->post_type}/%d";
	}
	$url = untrailingslashit( home_url( sprintf( $single_url, $post->ID ) ) );
	if ( $term ) {
		if ( is_numeric( $term ) ) {
			$term = get_term_by( 'id', $term, $taxonomy );
		} elseif ( is_string( $term ) ) {
			$term = get_term_by( 'slug', $term, $taxonomy );
		} else {
			$term = get_term( $term, $taxonomy );
		}
		if ( $term && ! is_wp_error( $term ) ) {
			$url .= sprintf( '/' . ltrim( $child_suffix, '/' ), rawurlencode( $term->slug ) );
		}
	}
	return $url;
}

/**
 * Detect if current user is customer.
 *
 * @param null|int|WP_Post $post
 * @param int $user_id
 *
 * @return bool
 */
function hakama_is_customer( $post = null, $user_id = 0 ) {
	if ( ! $user_id && ! ( $user_id = get_current_user_id() ) ) {
		return false;
	}
	$product = wc_get_product( get_post( $post ) );
	// Todo prepare for recurring payment.
	return wc_customer_bought_product( '', $user_id, $product->get_id() );
}

/**
 * Get post parent
 *
 * @param null|int|WP_Post $post
 *
 * @return WP_Post
 */
function hakama_get_brand( $post = null ) {
	return get_post( get_post( $post )->post_parent );
}

/**
 * Get brand thumbnail
 *
 * @param null|int|WP_Post $post
 * @param string           $size
 * @return string
 */
function hakama_brand_thumbnail( $post = null, $size = 'post-thumbnail' ) {
	$brand = hakama_get_brand( $post );
	if ( ! $brand ) {
		return '';
	}
	return get_the_post_thumbnail( $brand, $size );
}

/**
 * Get brand title.
 *
 * @param null|int|WP_Post $post
 * @return string
 */
function hakama_brand_title( $post = null ) {
	return get_the_title( hakama_get_brand( $post ) );
}

/**
 * @return bool
 */
function hakama_is_ex_customer() {
	return false;
}

/**
 * Get total count of cart item.
 *
 * @return int
 */
function hakama_cart_count() {
	if ( ! function_exists( 'WC' ) ) {
		return 0;
	} else {
		return min( 99, WC()->cart->get_cart_contents_count() );
	}
}
