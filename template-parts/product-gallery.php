<?php
global $product;
if ( ! ( $ids = $product->get_gallery_image_ids() ) ) {
	return;
}
$images = get_posts( [
	'post__in'       => $ids,
	'post_type'      => 'attachment',
	'orderby'        => 'post__in',
	'posts_per_page' => -1,
] );
if ( ! $images ) {
	return;
}
?>
<div class="alignfull">

	<div class="product-gallery-screen">
		<?php $counter = 0; foreach ( $images as $image ) : ?>
		<div id="product-slide-<?php echo $image->ID ?>" class="product-gallery-item <?php echo $counter ? '' : 'current' ?>"
			 style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( $image->ID, 'carousel' ) ) ?>);"
			 title="<?php echo esc_attr( get_the_title( $image ) ) ?>">
		</div>
		<?php $counter++; endforeach; ?>
	</div>

	<div class="product-gallery-thumbnails">
		<div class="swiper-container product-gallery-thumbnails-container">

			<div class="swiper-wrapper">
				<?php $counter = 0; foreach ( $images as $image ) : ?>
					<a href="#product-slide-<?php echo $image->ID ?>" class="swiper-item product-gallery-thumbnail <?php echo $counter ? '' : 'current' ?>">
						<img src="<?php echo wp_get_attachment_image_url( $image->ID, 'thumbnail' ) ?>"
							 alt="<?php echo esc_attr( get_the_title( $image ) ) ?>"/>
					</a>
				<?php $counter++; endforeach; ?>
			</div>

			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>

</div>
