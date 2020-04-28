<?php
$product = hakama_get_current_product();
?>
<div class="entry-header">

	<div class="brand-title-block">
		<?php if ( $product && has_post_thumbnail( $product ) ) : ?>
			<?php echo get_the_post_thumbnail( $product, 'post-thumbnail', [ 'class' => 'brand-title-block-img support-by-author-thumbnail' ] ) ?>
		<?php endif; ?>
		<h1 class="support-by-author-title f-serif">
			<?php echo hakama_product_title( $product ?: -1 ) ?>
		</h1>

	</div>
</div>
