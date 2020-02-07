<?php
$product = hakama_get_current_product();
if ( ! $product ) {
	return;
}
?>
<div class="entry">

	<div class="alignfull entry-nav-divider">

		<nav class="container">

			<ul class="entry-nav-list">

				<li class="entry-nav-item">
					<a class="entry-nav-link<?php echo is_singular( 'product' ) ? ' active' : '' ?>" href="<?php the_permalink( $product ); ?>">
						<?php esc_html_e( 'Product Detail','hakama' ) ?>
					</a>
				</li>

				<li class="entry-nav-item">
					<a class="entry-nav-link" href="<?php echo home_url( sprintf( '/faq/of/%d', $product->ID ) ) ?>">
						<?php esc_html_e( 'Documents','hakama' ) ?></a>
				</li>

				<li class="entry-nav-item">
					<a class="entry-nav-link<?php echo ( is_singular( 'thread' ) || is_post_type_archive( 'thread' ) || is_tax( 'topic' ) ) ? ' active' : '' ?>" href="<?php echo hakama_support_page( $product->ID ) ?>">
						<?php esc_html_e( 'Forum','hakama' ) ?>
					</a>
				</li>

			</ul>
		</nav>
	</div>

</div>
