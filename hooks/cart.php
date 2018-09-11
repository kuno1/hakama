<?php
/**
 * Add cart hooks
 *
 * @package hakama
 */

/**
 * Add cart total to fragment
 *
 * @param array $fragments
 * @return array
 */
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
	$fragments['cart_total'] = WC()->cart->get_cart_contents_count();
	return $fragments;
} );


