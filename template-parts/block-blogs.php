<?php
/**
 * @var int $limit    Limit
 * @var int $category
 */
$arg = [
	'post_type'      => 'post',
	'posts_per_page' => $limit,
	'post_status'    => 'publish',
];
if ( $category ) {
	$arg['tax_query'] = [[
		'taxonomy' => 'category',
		'field'    => 'id',
		'value'    => (int) $category,
	]];
}
$query = new WP_Query( $arg );
if ( ! $query->have_posts() ) {
	return '';
}
?>

<div class="row block-blog-wrapper">
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<div class="col block-blog-item">
		<?php hakama_template( 'loop', get_post_type() ) ?>
	</div>
	<?php endwhile; wp_reset_postdata(); ?>
</div>
