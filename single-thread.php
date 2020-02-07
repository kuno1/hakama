<?php get_header(); ?>

<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">

		<main id="content">
			<?php the_post(); ?>

			<?php hakama_template( 'header', hakama_template_group() ) ?>

			<?php hakama_template( 'entry-nav', hakama_template_group() ) ?>

			<?php if ( $product = wp_get_post_parent_id( get_post() ) ) : ?>
				<div class="entry">
					<div class="gap-element">
						<a class="btn btn-link" href="<?php echo home_url( sprintf( 'support/%d', $product ) ) ?>">
							<i class="fas fa-long-arrow-alt-left"></i> <?php esc_html_e( 'Return to Support Forum', 'hakama' ) ?>
						</a>
					</div>
				</div>
			<?php endif; ?>


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
