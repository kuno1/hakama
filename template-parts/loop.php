<li <?php post_class( [ 'loop-item' ] ) ?>>
	<div class="card loop-card">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'card-img-top' ] ) ?>
		<?php endif; ?>
		<div class="card-body">

			<h2 class="loop-title card-title">
				<?php the_title() ?>
			</h2>
			<p class="card-subtitle text-muted loop-meta mb-2">
				<i class="fa fa-calendar"></i> <?php the_date() ?>
				<i class="fa fa-user"></i> <?php the_author(); ?>
			</p>

			<div class="card-text">
				<?php the_excerpt() ?>
			</div>
			<div class="text-center">

				<a href="<?php the_permalink() ?>" class="btn btn-link btn-sm">
					<?php esc_html_e( 'Read More', 'hakama' ); ?>
					<i class="fa fa-arrow-alt-circle-right"></i>
				</a>
			</div>

		</div>
	</div>

</li>
