<?php
/**
 * Template Name: Wizard Page
 */
get_header( 'meta' );
?>

	<header class="site-header text-center" role="banner">

		<div class="site-header-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo() ?>
			<?php else : ?>
				<a class="custom-logo-link" href="<?php echo home_url() ?>" rel="home">
					<span class="site-header-brand-text"><?php bloginfo( 'name' ) ?></span>
				</a>
			<?php endif; ?>
		</div>
	</header>

	<?php do_action( 'hakama_header_notification' ); ?>

	<section class="section-main">
			<main id="content">
				<?php the_post(); ?>
				<article class="entry">
					<header class="entry-meta">
						<h1 class="entry-title entry-title-wide has-text-align-center is-style-overline"><?php the_title(); ?></h1>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<?php hakama_template( 'entry-footer-page', get_post()->post_name ); ?>
				</article>
			</main>

	</section>

<?php get_footer( 'thin' );
