<?php
$product = hakama_get_current_product();
if ( ! $product ) {
	return;
}
$brand = get_post( $product->post_parent );
?>

<aside class="support-by-author">

	<div class="brand-title-block">
		<?php if ( has_post_thumbnail( $brand ) ) : ?>
			<?php echo get_the_post_thumbnail( $brand, 'post-thumbnail', [ 'class' => 'brand-title-block-img support-by-author-thumbnail' ] ) ?>
		<?php endif; ?>
		<h2 class="support-by-author-title"><?php echo esc_html( get_the_title( $brand ) ) ?></h2>
	</div>

	<div class="text-center mb-5">
		<?php echo get_the_excerpt( $brand ) ?>
	</div>

	<p class="text-center">
		<a href="<?php echo home_url( sprintf( '/support/%d', $product->ID ) ); ?>" class="btn btn-outline-primary">
			<i class="fas fa-life-ring"></i>
			<?php esc_html_e( 'Get Support', 'hakama' ) ?>
		</a>
	</p>

	<?php
	$sub_query = new WP_Query( [
		'post_type'      => 'post',
		'post_parent'    => $brand->ID,
		'posts_per_page' => 3,
	] );
	if ( $sub_query->have_posts() ) :
	?>
	<div class="brand-info">
		<h3 class="has-text-align-center is-style-separator f-sans">
			<?php esc_html_e( 'Informations', 'hakama' ) ?>
		</h3>
		<ul class="post-list">
			<?php while( $sub_query->have_posts() ) {
				$sub_query->the_post();
				hakama_template( 'kbl/post-loop' );
			} ?>
		</ul>
	</div>
	<?php wp_reset_postdata(); endif; ?>
</aside>



