<?php
/**
 * Post loop for KBL Post list in card layout..
 */

$thumbnail = sprintf( 'background-image: url(\'%s\')', esc_url(
	has_post_thumbnail() ? get_the_post_thumbnail_url( get_post() ): get_template_directory_uri() . '/assets/img/kunoichi-dammy.png'
	) );
?>
<div class="post-card-item">
	<a href="<?php the_permalink(); ?>" class="post-card-link">

		<div class="post-card-thumbnail" style="<?php echo esc_attr( $thumbnail ) ?>">
		</div>
		<div class="post-card-body">
			<p class="post-card-title"><?php the_title() ?></p>
			<div class="post-card-meta">
				<span class="post-card-date">
					<i class="far fa-clock"></i> <?php the_time( get_option( 'date_format' ) ) ?>
				</span>
			</div>
			<div class="post-card-meta text-right">
				<span class="post-card-author">
					<i class="fas fa-pen"></i> <?php echo esc_html( hakama_document_owner() ) ?>
				</span>
			</div>
		</div>
		<?php if ( $term = hakama_top_category() ) : ?>
			<span class="post-card-term"><?php echo esc_html( $term->name ) ?></span>
		<?php endif; ?>
	</a>
</div>
