<?php
$product = hakama_get_current_product();
if ( ! $product ) {
	return;
}

// Parent URL.
$parent = null;
$label  = '';
if ( is_singular( 'thread' ) || is_tax( 'topic' ) ) {
	$parent = home_url( sprintf( 'support/%d', $product->ID ) );
	$label = __( 'Return to Support Forum', 'hakama' );
} elseif ( is_singular( 'faq' ) || is_tax( 'faq_cat' ) ) {
	$parent = home_url( sprintf( 'faq/of/%d', $product->ID ) );
	$label = __( 'Return to Documents List', 'hakama' );
}
if ( ! $parent ) {
	return;
}
?>

<div class="entry">
	<div class="<?php hakama_class_names( [
		'gap-element'   => true,
		'border-top'    => get_query_var( 'border-top' ),
		'border-bottom' => get_query_var( 'border-bottom' ),
		'pt-0'          => get_query_var( 'pt-0' ),
	] ); ?>">
		<a class="btn btn-link" href="<?php echo  esc_url( $parent ) ?>">
			<i class="fas fa-long-arrow-alt-left"></i> <?php echo esc_html( $label ) ?>
		</a>
	</div>
</div>
