<?php
/**
 * Customize single product page.
 *
 * @package hakama
 */



//
// Remove all hook from single product summary
// @see woocommerce/templates/content-single-product.php
//
foreach ( [
		'woocommerce_before_single_product_summary' => [
			'woocommerce_show_product_sale_flash' => 10,
			'woocommerce_show_product_images' => 20,
		],
		'woocommerce_single_product_summary' => [
			'woocommerce_template_single_title'   => 5,
			'woocommerce_template_single_rating' => 10,
			'woocommerce_template_single_excerpt' => 20,
			'woocommerce_template_single_meta'    => 40,
		],
	] as $hook_name => $functions ) { foreach ( $functions as $function => $priority ) {
		remove_action( $hook_name, $function, $priority );
	}
}

// Load meta to WooCommerce
add_action( 'woocommerce_before_single_product_summary', function() {
	hakama_template( 'header-product' );
}, 1 );

// Load main content of Product
add_action( 'woocommerce_before_single_product_summary', function() {
	echo '<div class="product-body row">';
	hakama_template( 'content-product' );
}, 9998 );
// Add closing tag to product summary.
add_action( 'woocommerce_after_single_product_summary', function() {
	echo '</div><!-- //.product-body -->';
}, 1 );

// Remove content from tabs.
add_filter( 'woocommerce_product_tabs', function( $tabs ) {
	if ( isset( $tabs['description'] ) ) {
		unset( $tabs['description'] );
	}
	return $tabs;
} );

// Add wrapper for cart.
add_action( 'woocommerce_single_product_summary', function(){
	echo '<div class="widget widget-product product-checkout">';
}, 9 );
add_action( 'woocommerce_single_product_summary', function(){
	echo '</div><!-- widget-support -->';
}, 31 );

// Add formats.
foreach ( [
	'product-meta'    => 40,
	'product-files'   => 41,
	'product-brand'   => 42,
	'product-support' => 43,
] as $template => $priority ) {
	add_action( 'woocommerce_single_product_summary', function() use ( $template ) {
		hakama_template( $template );
	}, $priority );
}

// Change max quantity
add_filter( 'woocommerce_quantity_input_max', function() {
	return 1;
} );
