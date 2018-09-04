<?php get_header(); ?>

<section class="section-main">

	<div class="container">

		<div class="row">

			<main id="content" class="col-sm-12 col-md-9">
				<?php the_post(); ?>

				<article class="entry">
					<header class="entry-meta">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<footer class="entry-footer">
						aaa
					</footer>
				</article>
			</main>

			<div class="col-sm-12 col-md-3">
				<?php get_sidebar() ?>
			</div>
		</div>
	</div>
	
</section>

<?php get_footer();
