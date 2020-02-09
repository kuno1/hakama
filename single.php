<?php
get_header();
hakama_template( 'breadcrumb' );
?>

	<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">

		<main id="content">
			<?php the_post(); ?>

			<article class="entry">

				<?php hakama_template( 'entry-meta', get_post_type() ) ?>

				<div class="entry-content">

					<?php if ( function_exists( 'shouyaku_post_notification' ) ) {
						shouyaku_post_notification();
					} ?>

					<?php the_content(); ?>
				</div>
				<?php hakama_template( 'entry-footer', get_post_type() ) ?>
			</article>
		</main>


		<?php hakama_template( 'after-main', hakama_template_group() ) ?>


	</section>


<?php get_footer();
