<?php
$product = hakama_get_current_product();
if ( ! $product ) {
	return;
}
$brand = get_post( $product->post_parent );
?>

<aside class="support-by-author">

	<div class="brand-title-block">
		<?php if ( has_post_thumbnail( $product ) ) : ?>
			<?php echo get_the_post_thumbnail( $product, 'post-thumbnail', [ 'class' => 'brand-title-block-img support-by-author-thumbnail' ] ) ?>
		<?php endif; ?>
		<h2 class="support-by-author-title"><?php echo esc_html( sprintf( __( 'Contact About %s', 'hakama' ), get_the_title( $product ) ) ) ?></h2>
	</div>

	<p class="text-center">
		<?php esc_html_e( 'Do you have something to ask plugin/theme to? Feel free to contact.', 'hakama' ) ?>
	</p>

	<?php if ( $brand ) : ?>
		<p class="support-by-author-brand text-center">
			<?php if ( has_post_thumbnail( $brand ) ) : ?>
				<?php echo get_the_post_thumbnail( $brand, 'post-thumbnail', [ 'class' => 'brand-title-block-img' ] ) ?>
			<?php endif; ?>
			<span><?php echo esc_html( get_the_title( $brand ) ) ?></span>
		</p>
	<?php endif; ?>

	<p class="text-center">
		<a href="<?php echo add_query_arg( [ 'product-id' => $product->ID ], home_url( 'contact-author' ) ); ?>" class="btn btn-outline-primary">
			<i class="far fa-envelope"></i>
			<?php esc_html_e( 'Contact About Product', 'hakama' ) ?>
		</a>
	</p>
</aside>



