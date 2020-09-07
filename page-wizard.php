<?php
/**
 * Template Name: Wizard Page
 */
get_header( 'meta' );
?>

	<header class="site-header site-header-thin" role="banner">
		<div class="container site-header-container">
			<?php hakama_template( 'header-brand' ) ?>

			<?php get_template_part( 'template-parts/navigation', 'shopping-guide' ); ?>
		</div>
	</header>

	<?php do_action( 'hakama_header_notification' ); ?>

	<section class="section-main">

		<main id="content">
			<?php the_post(); ?>
			<article class="entry">
				<header class="entry-meta entry-meta-wizard">
					<h1 class="entry-title entry-title-wide has-text-align-center is-style-overline"><?php the_title(); ?></h1>
				</header>

				<?php get_template_part( 'template-parts/navigation', 'checkout' ); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<?php get_template_part( 'template-parts/navigation-return', 'shop' ); ?>

				<?php hakama_template( 'entry-footer-page', get_post()->post_name ); ?>


			</article>
		</main>


	</section>

<?php get_footer( 'thin' );
