<?php
$product = hakama_get_current_product();
if ( ! $product || ! ( $brand = get_post( $product->post_parent ) ) ) {
	return;
}
$sub_query = new WP_Query( [
	'post_type' 	 => 'product',
	'meta_key'  	 => 'total_sales',
	'orderby'   	 => 'meta_value_num',
	'order' 		 => 'desc',
  	'tax_query'      => [ [
		'taxonomy' => 'product_cat',
		'terms'    => [ 'theme', 'plugin' ],
		'field'    => 'slug',
	] ],
  	'posts_per_page' => 5,
] );
if ( ! $sub_query->have_posts() ) {
	return;
}
?>
	<div class="product-popular-block">
		<h2 class="has-text-align-center is-style-overline f-serif mb-5">
			<?php esc_html_e( 'Popular Products', 'hakama' ) ?>
		</h2>
		<div class="post-circle-container swiper-container">

			<div class="post-circle swiper-wrapper">
				<?php while ( $sub_query->have_posts() ) {
					$sub_query->the_post();
					hakama_template( 'kbl/post-loop-circle' );
				} ?>
			</div>

			<div class="swiper-pagination post-circle-pagination"></div>
			<div class="swiper-button-prev post-circle-prev"></div>
			<div class="swiper-button-next post-circle-next"></div>
		</div>
	</div>
<?php wp_reset_postdata();
