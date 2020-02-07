<?php get_header() ?>

	<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">

		<div class="entry">

			<main id="content">

				<?php hakama_template( 'header', hakama_template_group() ) ?>

				<?php hakama_template( 'entry-nav', hakama_template_group() ) ?>

				<?php if ( have_posts() ) : ?>
					<ul class="loop-list">
						<?php while ( have_posts() ) {
							the_post();
							hakama_template( 'loop', get_post_type() );
						} ?>
					</ul>
					<div class="text-center">
						<?php hakama_pagination() ?>
					</div>
				<?php else : ?>
					<?php hakama_template( 'content-no', hakama_template_group() ) ?>
				<?php endif; ?>

				<?php hakama_template( 'after-main', hakama_template_group() ); ?>

			</main>

		</div>
	</section>

<?php get_footer();
