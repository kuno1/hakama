<?php
/**
 * Template Name: No Header
 */
get_header(); ?>

	<section class="section-main section-main-single">
		<?php the_post(); ?>
		<main id="content">
			<article class="entry">
				<div class="entry-content entry-block">
					<?php the_content() ?>
				</div>
			</article>
		</main>
	</section>

<?php get_footer();
