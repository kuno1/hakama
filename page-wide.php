<?php
/**
 * Template Name: Wide Page
 */
get_header(); ?>
	
	<section class="section-main">
		
		<div class="container">
			
			<div class="row">
				
				<main id="content" class="col-sm-12">
					<?php the_post(); ?>
					
					<article class="entry">
						<header class="entry-meta">
							<h1 class="entry-title entry-title-wide"><?php the_title(); ?></h1>
						</header>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<?php hakama_template( 'entry-footer-page', get_post()->post_name ); ?>
					</article>
				</main>
			</div>
		</div>
	
	</section>

<?php get_footer();
