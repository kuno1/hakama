<?php
$product = hakama_get_current_product();
if ( ! $product ) {
	return;
}

$classes = hakama_class_names( [

] );
$no_border_top = get_query_var(' no-border-top' ) ? ' no-' : '';
?>
<div class="entry">

	<div class="<?php hakama_class_names( [
		'alignfull'         => true,
		'entry-nav-divider' => true,
		'no-border-top'     => get_query_var( 'no-border-top' ),
		'no-border-bottom'  => get_query_var( 'no-border-bottom' ),
	] ); ?>">

		<nav class="container">

			<ul class="entry-nav-list">

				<li class="entry-nav-item">
					<a class="entry-nav-link<?php echo is_singular( 'product' ) ? ' active' : '' ?>" href="<?php the_permalink( $product ); ?>">
						<?php esc_html_e( 'Product Detail','hakama' ) ?>
					</a>
				</li>

				<li class="entry-nav-item">
					<a class="entry-nav-link<?php echo ( is_singular( 'faq' ) || is_post_type_archive( 'faq' ) || is_tax( 'faq_cat' ) ) ? ' active' : '' ?>" href="<?php echo home_url( sprintf( '/faq/of/%d', $product->ID ) ) ?>">
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

<?php
hakama_template( 'entry-nav-parent' );
