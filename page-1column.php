<?php
/**
 * Template Name: Single Column
 */
get_header(); ?>
	
	<section class="section-main section-main-single">
		<?php the_post(); ?>
		<article class="entry entry-block entry-content">
			<?php the_content() ?>
		</article>
	</section>

<?php get_footer();
