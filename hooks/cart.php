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


add_filter( 'woocommerce_loop_add_to_cart_args', function( $args, $product ) {
	$classes = [];
	foreach ( explode( ' ', $args['class'] ) as $c ) {
		switch( $c ) {
			case 'button':
				$classes[] = 'btn';
				$classes[] = 'btn-block';
				$classes[] = 'btn-outline-primary';
				break;
			default:
				$classes[] = $c;
				break;
		}
	}
	$args['class'] = implode( ' ', $classes );
	return $args;
}, 10, 2 );

/**
 * Filter loop template for product.
 */
add_filter( 'wc_get_template_part', function( $template, $slug, $name ) {
	if ( 'content' === $slug && 'product' === $name ) {
		$template = get_stylesheet_directory() . '/template-parts/loop.php';
	}
	return $template;
}, 10, 3 );
