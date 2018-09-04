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

<?php get_footer( 'thin' );
