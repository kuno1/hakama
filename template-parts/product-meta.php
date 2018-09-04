<?php
/** @var WC_Product $product */
global $product;
?>
<div class="product-meta widget widget-product">

	<?php
	$tags = get_the_terms( $product->get_id(), 'product_tag' );
	if ( $tags && ! is_wp_error( $tags )  ) {
		printf( '<p class="product-meta-tags">%s</p>', implode( ' ', array_map( function( $tag ) {
			return sprintf( '<a class="btn btn-outline-info btn-sm" href="%s"><i class="fa fa-tag"></i> %s</a>', get_term_link( $tag ), esc_html( $tag->name ) );
		}, $tags ) ) );
	}
	?>
	<dl class="product-meta-list">
		<?php foreach ( [
				[ '_required_wp_version', esc_html__( 'Required WordPress Version', 'hakama' ), __( ' and over', 'hakama' ) ],
				[ '_tested_up_to', esc_html__( 'Tested Up To', 'hakama' ), '.x' ],
				[ '_required_php_version', esc_html__( 'Required PHP Version', 'hakama' ), __( ' and over', 'hakama' ) ],
		] as list( $key, $label, $suffix ) ) {
			?>
			<dt><?php echo $label ?></dt>
			<dd>
				<?php if ( $value = get_post_meta( $product->get_id(), $key, true ) ) : ?>
					<?php echo esc_html( $value.$suffix ) ?>
				<?php else : ?>
					<span class="disabled text-muted">---</span>
				<?php endif; ?>
			</dd>
			<?php
		} ?>
	</dl>
	
</div>
