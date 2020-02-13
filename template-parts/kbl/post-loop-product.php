<?php
/**
 * Post loop for KBL Post list.
 */

$thumbnail = has_post_thumbnail() ? sprintf( 'background-image: url(\'%s\')', esc_url( get_the_post_thumbnail_url( get_post() ) ) ) : '';
// TODO: change thumbnail size as of product taxonomy.
?>
<li <?php post_class( 'product-list-item' ); ?>>
	<div class="product-list-thumbnail" style="<?php echo esc_attr( $thumbnail ) ?>">
		<?php if ( $category = hakama_top_category() ) : ?>
			<a class="product-list-term" href="<?php echo get_term_link( $category ) ?>">
				<?php echo esc_html( $category->name ) ?>
			</a>
		<?php endif;?>
	</div>
	<div class="product-list-body">

		<p class="product-list-title"><?php the_title() ?></p>

		<div class="product-list-meta">
			<?php the_excerpt(); ?>
		</div>


		<a href="<?php the_permalink(); ?>" class="product-list-link">
			<?php echo esc_html_x( 'Detail', 'product-link', 'hakama' ) ?> &raquo;
		</a>
	</div>
</li>
