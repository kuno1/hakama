<?php
/**
 * Post loop for KBL Post list in circle layout.
 */
?>
<div class="post-circle-item swiper-slide">
	<a href="<?php the_permalink(); ?>" class="post-circle-link">

		<div class="post-circle-thumbnail">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'thumbnail', [ 'class' => 'post-circle-img', ] ); ?>
			<?php else : ?>
				<img src="<?php echo get_template_directory_uri() ?>/assets/img/kunoichi-dammy.png" alt="" class="post-circle-img" width="200" height="200" />
			<?php endif; ?>
		</div>

		<div class="post-circle-body">

			<p class="post-circle-category">
				<?php if ( $term = hakama_top_category() ) : ?>
					<span class="post-circle-term"><?php echo esc_html( $term->name ) ?></span>
				<?php endif; ?>
			</p>

			<p class="post-circle-title"><?php the_title() ?></p>

		</div>
	</a>
</div>
