<?php
/**
 * Post loop for KBL Post list.
 */

$thumbnail = sprintf( 'background-image: url(\'%s\')', esc_url(
	has_post_thumbnail() ? get_the_post_thumbnail_url( get_post() ): get_template_directory_uri() . '/assets/img/kunoichi-dammy.png'
) );
// TODO: change thumbnail size as of product taxonomy.
?>
<li <?php post_class( 'product-list-item' ); ?>>
	<div class="product-list-inner">
		<div class="product-list-thumbnail" style="<?php echo esc_attr( $thumbnail ) ?>">
			<?php if ( $category = hakama_top_category() ) : ?>
				<a class="product-list-term" href="<?php echo get_term_link( $category ) ?>">
					<?php echo esc_html( $category->name ) ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="product-list-body">

			<p class="product-list-title"><?php the_title() ?></p>

			<div class="product-list-meta">
				<?php the_excerpt(); ?>
			</div>

		</div>

		<a href="<?php the_permalink(); ?>" class="product-list-link">
			<?php echo esc_html_x( 'Detail', 'product-link', 'hakama' ) ?> &raquo;
		</a>
	</div>
</li>
