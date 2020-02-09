<?php get_header(); ?>

<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">

		<main id="content">
			<?php the_post(); ?>

			<?php hakama_template( 'header', hakama_template_group() ) ?>

			<?php hakama_template( 'entry-nav', hakama_template_group() ) ?>

			<article class="entry entry-thread">
				<?php hakama_template( 'entry-meta', get_post_type() ) ?>
				<div class="entry-content entry-content-thread">
					<?php if ( function_exists( 'shouyaku_post_notification' ) ) {
						shouyaku_post_notification();
					} ?>
					<?php the_content(); ?>
				</div>
			</article>

			<?php hakama_template( 'entry-footer', get_post_type() ) ?>
		</main>

		<div class="entry">
			<?php hakama_template( 'related-faq' ) ?>
		</div>

		<?php hakama_template( 'after-main', 'support' ) ?>
	</section>

<?php get_footer();
