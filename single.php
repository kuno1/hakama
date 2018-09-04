<?php get_header(); ?>

	<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">
		
		<div class="container">
			
			<div class="row">
				
				<main id="content" class="col-sm-12 col-md-9">
					<?php the_post(); ?>
					
					<article class="entry">
						<?php hakama_template( 'entry-meta', get_post_type() ) ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<?php hakama_template( 'entry-footer', get_post_type() ) ?>
					</article>
				</main>
				
				<div class="col-sm-12 col-md-3">
					<?php get_sidebar( get_post_type() ) ?>
				</div>
			</div>
		</div>
	
	</section>

<?php get_footer();
