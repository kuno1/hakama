<?php
get_header();
hakama_template( 'breadcrumb' );
?>

	<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">

		<main id="content">
			<?php the_post(); ?>

			<?php hakama_template( 'header', hakama_template_group() ) ?>

			<?php hakama_template( 'entry-nav', hakama_template_group() ) ?>

			<article class="entry entry-<?php echo esc_attr( get_post_type() ) ?>">

				<?php hakama_template( 'entry-meta', get_post_type() ) ?>

				<div class="entry-content">

					<?php if ( function_exists( 'shouyaku_post_notification' ) ) {
						shouyaku_post_notification();
					} ?>

					<?php the_content(); ?>
				</div>
				<?php hakama_template( 'entry-footer', get_post_type() ) ?>

				<div class="entry">
					<?php hakama_template( 'related', get_post_type(), [
						'border-top' => true,
					] ) ?>
				</div>
			</article>
		</main>

		<?php if ( get_post()->post_parent ) {
			hakama_template( 'entry-nav-parent', '', [
				'border-bottom' => true,
				'pt-0'          => true,
			] );
		} ?>

		<?php hakama_template( 'after-main', hakama_template_group() ) ?>


	</section>


<?php get_footer();
