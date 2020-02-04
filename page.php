<?php
get_header();
get_template_part( 'template-parts/breadcrumb' );
?>

	<section class="section-main">

			<main id="content">
				<?php the_post(); ?>

				<article class="entry">
					<header class="entry-meta">
						<h1 class="entry-title entry-title-wide has-text-align-center is-style-overline">
							<?php the_title(); ?>
						</h1>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<?php hakama_template( 'entry-footer-page', get_post()->post_name ); ?>
				</article>
			</main>

	</section>

<?php get_footer();
