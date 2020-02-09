<?php get_header(); ?>

<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">

		<main id="content">
			<?php the_post(); ?>

			<?php hakama_template( 'header', hakama_template_group() ) ?>

			<?php hakama_template( 'entry-nav', hakama_template_group() ) ?>

			<article class="entry entry-faq">
				<?php hakama_template( 'entry-meta', get_post_type() ) ?>
				<div class="entry-content">
					<?php if ( function_exists( 'shouyaku_post_notification' ) ) {
						shouyaku_post_notification();
					} ?>
					<?php the_content(); ?>
				</div>
			</article>

			<?php hakama_template( 'entry-footer', get_post_type() ) ?>

			<div class="entry">
				<?php hakama_template( 'related-faq', '', [
					'border-top' => true,
				] ) ?>
			</div>
		</main>


		<?php hakama_template( 'entry-nav-parent', '', [
			'border-bottom' => true,
			'pt-0'          => true,
		] ); ?>

		<?php hakama_template( 'after-main', 'support' ) ?>


	</section>

<?php get_footer();
