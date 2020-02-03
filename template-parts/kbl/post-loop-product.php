<?php
/**
 * Post loop for KBL Post list.
 */

$thumbnail = has_post_thumbnail() ? sprintf( 'background-image: url(\'%s\')', esc_url( get_the_post_thumbnail_url( get_post() ) ) ) : '';
// TODO: change thumbnail size as of product taxonomy.
?>
<li <?php post_class( 'product-list-item' ); ?>>
	<div class="product-list-thumbnail" style="<?php echo esc_attr( $thumbnail ) ?>">
	</div>
	<div class="product-list-body">

		<p class="product-list-title"><?php the_title() ?></p>

		<div class="product-list-meta">
			<?php the_excerpt(); ?>
		</div>


		<a href="<?php the_permalink(); ?>" class="product-list-link">
			<?php esc_html_e( '詳しく', 'hakama' ) ?> &raquo;
		</a>
	</div>
</li>
