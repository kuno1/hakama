<div class="entry-summary woocommerce">

<?php
if ( ( $parent = hakama_document_parent() ) && 'product' === get_post_type( $parent ) ) {
	global $product;
	$product = wc_get_product( $parent );
}
do_action( 'woocommerce_single_product_summary' );
?>

</div>
