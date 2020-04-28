<?php

$args = [
	'post_type'      => 'faq',
	'post_status'    => 'publish',
	'posts_per_page' => 4,
	'no_found_post'  => true,
];
$link       = '';
$link_label = '';
$product    = hakama_get_current_product();
$term       = hakama_top_category( get_queried_object() );
if ( $product ) {
	$args[ 'post_parent' ] = $product->ID;
	if ( $term ) {
		$link       = hakama_documentation_url( $product, $term );
		$link_label = sprintf( __( 'See documents in %s', 'hakama' ), $term->name );
	}
} else {
	$args[ 'post_parent' ] = 0;
	if ( $term ) {
		$args[ 'tax_query' ] = [
			[
				'taxonomy' => $term->taxonomy,
				'field'    => 'id',
				'terms'    => $term->term_id,
			]
		];
		$link       = get_term_link( $term );
		$link_label = sprintf( __( 'See documents in %s', 'hakama' ), $term->name );
	} else {
		$link       = hakama_documentation_top_page();
		$link_label = __( 'Documentation Top', 'hakama' );
	}
}
if ( is_singular( 'faq' ) ) {
	$args['post__not_in'] = [ get_queried_object_id() ];
}
$query = new WP_Query( $args );
?>
<div class="<?php hakama_class_names( [
	'related-blocks' => true,
	'border-top'     => get_query_var( 'border-top'),
] ) ; ?>">
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
			<?php esc_html_e( 'No related document.', 'hakama' ) ?>
		</div>
	<?php endif; ?>

	<?php if ( $link ) : ?>
	<div class="text-center my-5">
		 <a class="btn btn-outline-primary" href="<?php echo esc_url( $link ) ?>">
			 <?php echo esc_html( $link_label ) ?>
		 </a>
	</div>
	<?php endif; ?>
</div>
