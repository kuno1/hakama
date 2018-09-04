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
							<h1 class="entry-title text-center"><?php the_title(); ?></h1>
						</header>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<footer class="entry-footer">
							aaa
						</footer>
					</article>
				</main>
			</div>
		</div>
	
	</section>

<?php get_footer();
