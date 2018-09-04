<?php
/** @var WC_Product $product */
global $product;

if ( ! $product || ! ( $attachment_ids = $product->get_gallery_image_ids() ) ) {
	return;
}
?>

<div class="product-gallery">
	
	<div id="carousel-indicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php foreach ( $attachment_ids as $index => $attachment ) : ?>
			<li data-target="#carousel-indicators" data-slide-to="<?php echo $index ?>" class="<?php echo $index ? '' : 'active' ?>"></li>
			<?php endforeach; ?>
		</ol>
		<div class="carousel-inner">
			<?php foreach ( $attachment_ids as $index => $attachment ) : ?>
			<div class="carousel-item<?php echo $index ? '' : ' active' ?>">
				<?php echo wp_get_attachment_image( $attachment, 'carousel', false, [ 'class' => 'd-block w-100', ] ) ?>
				<div class="carousel-caption d-none d-md-block">
					<h5><?php echo esc_html( get_the_title( $attachment ) ) ?></h5>
					<?php if ( has_excerpt( $attachment ) ) : ?>
					<p><?php echo wp_kses_post( get_the_excerpt( $attachment ) ) ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<a class="carousel-control-prev" href="#carousel-indicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only"><?php esc_html_e( 'Previous', 'hakama' ) ?></span>
		</a>
		<a class="carousel-control-next" href="#carousel-indicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only"><?php esc_html_e( 'Next', 'hakama' ) ?></span>
		</a>
	</div>
	
</div>
