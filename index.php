<?php get_header() ?>

	<?php hakama_template( 'before-main', hakama_template_group() ) ?>

	<section class="section-main">

		<div class="container">

			<div class="row">

				<main id="content" class="col-sm-12">
					
					<div class="entry-meta">
						<h1 class="entry-title">
							<?php hakama_archive_title() ?>
							<?php if ( have_posts() ) : ?>
							<small>
								<?php
								global $wp_query;
								printf(
									esc_html__( '%s Found( %d / %d Page)', 'hakama' ),
									number_format( $wp_query->found_posts ),
									max( 1, (int) $wp_query->get( 'paged' ) ),
									$wp_query->max_num_pages
								);
								?>
							</small>
							<?php endif; ?>
						</h1>
					</div>
					
					<?php hakama_template( 'entry-nav', hakama_template_group() ) ?>
					
					<?php if ( have_posts() ) : ?>
						<ul class="loop-list card-columns">
							<?php while ( have_posts() ) {
								the_post();
								hakama_template( 'loop', get_post_type() );
							} ?>
						</ul>
						<div class="text-center">
							<?php hakama_pagination() ?>
						</div>
					<?php else : ?>
						<?php hakama_template( 'content-no', hakama_template_group() ) ?>
					<?php endif; ?>
					
					<?php hakama_template( 'after-main', hakama_template_group() ); ?>
					
				</main>
			</div>
		</div>
	</section>

<?php get_footer();
