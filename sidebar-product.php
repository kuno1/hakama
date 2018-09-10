<div class="entry-summary woocommerce">

<?php
global $product;
$product = wc_get_product( hakama_document_parent() );
do_action( 'woocommerce_single_product_summary' );
?>

</div>
