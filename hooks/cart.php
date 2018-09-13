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

/**
 * Add return link at the end of checkout.
 */
add_action( 'woocommerce_checkout_after_order_review', function() {
	?>
	<p class="mt-4 text-center">
		<a class="btn btn-link btn-sm" href="<?php echo wc_get_page_permalink( 'shop' ) ?>">
			<i class="far fa-arrow-alt-circle-left"></i>
			<?php esc_html_e( 'Continue Shopping', 'hakama' ) ?>
		</a>
	</p>
	<?php
} );


/**
 * Arrange order.
 */
add_filter( 'woocommerce_checkout_fields', function( $fields ) {
	// Arrange.
	return $fields;
} );