<?php
global $product;
if ( ! ( $post_parent = get_post( $product->get_id() )->post_parent ) ) {
	return;
}
$brand = get_post( $post_parent );
if ( ! $brand || 'publish' !== $brand->post_status ) {
	return;
}
?>
<div class="brand-icon widget widget-product">
	<p class="brand-icon-prefix text-center text-muted"><?php esc_html_e( 'Crafted By', 'hakama' ) ?></p>
	<?php if ( has_post_thumbnail( $brand ) ) : ?>
		<a href="<?php echo get_permalink( $brand ) ?>">
			<?php echo get_the_post_thumbnail( $brand,  'post-thumbnail', [ 'class' => 'brand-icon-thumbnail' ] ) ?>
		</a>
	<?php endif; ?>
	<h2 class="brand-icon-title">
		<a href="<?php echo get_permalink( $brand ) ?>"><?php echo esc_html( get_the_title( $brand ) ) ?></a>
	</h2>
</div>
