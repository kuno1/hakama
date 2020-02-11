<?php
$product = hakama_get_current_product();
if ( ! $product || ! ( $brand = get_post( $product->post_parent ) ) ) {
	return;
}

$sub_query = new WP_Query( [
	'post_type'      => 'product',
	'post_parent'    => $brand->ID,
	'posts_per_page' => 3,
	'post__not_in'   => [ $product->ID ],
] );
if ( ! $sub_query->have_posts() ) {
	return;
}
?>
	<div class="product-see-also-blocks">
		<h2 class="has-text-align-center is-style-overline f-serif">
			<?php esc_html_e( 'Related Products', 'hakama' ) ?>
		</h2>
		<ul class="product-list">
			<?php while ( $sub_query->have_posts() ) {
				$sub_query->the_post();
				hakama_template( 'kbl/post-loop-product' );
			} ?>
		</ul>
	</div>
<?php wp_reset_postdata();
