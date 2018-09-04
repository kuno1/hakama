<?php
/** @var WC_Product $product */
global $product;
?>
<div class="product-support widget widget-product">

	<h2 class="widget-title widget-product-title"><?php esc_html_e( 'Documentation', 'hakama' ) ?></h2>
	
	<?php if ( $terms = hakama_terms( $product->get_id() ) ) : ?>
		<ul class="product-support-list nav flex-column  nav-pills">
			<?php foreach ( $terms as $term ) : ?>
				<li class="nav-item">
					<a href="<?php echo home_url( sprintf( '/faq/of/%d/in/%s', $product->get_id(), esc_attr( $term->slug ) ) ) ?>"
					   class="btn btn-outline-secondary btn-block">
						<?php echo esc_html( $term->name ) ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p class="text-muted"><?php esc_html_e( 'This product has no document!', 'hakama' ) ?></p>
	<?php endif; ?>

	<h2 class="widget-title widget-product-title"><?php esc_html_e( 'Support Forum', 'hakama' ) ?></h2>
	<ul class="product-support-list nav flex-column  nav-pills">
		<li class="nav-item">
			<a href="<?php echo home_url( sprintf( '/support/%d', $product->get_id() ) ) ?>"
			   class="btn btn-outline-secondary btn-block">
				<?php esc_html_e( 'See Support Forum', 'hakama' ) ?>
			</a>
		</li>
	</ul>

</div>
