<?php

$product = hakama_get_current_product();
if ( ! $product ) {
	return;
}
$args = [
	'post_type'      => 'faq',
	'post_parent'    => $product->ID,
	'posts_per_page' => 4,
	'no_found_post'  => true,
];
if ( is_singular( 'faq' ) ) {
	$args['post__not_in'] = [ get_queried_object_id() ];
}
$query = new WP_Query( $args );
?>
<div class="related-blocks">
	<h3 class="f-bold related-blocks-title"><?php esc_html_e( 'Related Documents', 'hakama' ) ?></h3>

	<?php if ( $query->have_posts() ) : ?>
		<ul class="loop-list loop-list-faq">
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				hakama_template( 'loop', get_post_type() );
			}
			wp_reset_postdata();
			?>
		</ul>
	<?php else : ?>
		<div class="alert alert-light text-center">
			<?php esc_html_e( 'This product has no related document.', 'hakama' ) ?>
		</div>
	<?php endif; ?>
</div>
