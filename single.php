<?php
get_header();
hakama_template( 'breadcrumb' );
hakama_template( 'before-main', hakama_template_group() );
?>
	<section class="section-main">
		<main id="content">
			<?php
			the_post();
			hakama_template( 'header', hakama_template_group() );
			hakama_template( 'entry-nav', hakama_template_group() );
			?>
			<article class="entry entry-<?php echo esc_attr( get_post_type() ) ?>">
				<?php hakama_template( 'entry-meta', get_post_type() ) ?>
				<div class="entry-content entry-content-<?php echo esc_attr( get_post_type() ) ?>">
					<?php if ( function_exists( 'shouyaku_post_notification' ) ) {
						shouyaku_post_notification();
					} ?>
					<?php the_content(); ?>
				</div>
				<?php
				hakama_template( 'entry-footer', get_post_type() );
				hakama_template( 'related', get_post_type(), [
					'border-top' => true,
				] );
				?>
			</article>
		</main>
		<?php
		hakama_template( 'entry-nav-parent', '', [
			'border-bottom' => true,
			'pt-0'          => true,
		] );
		hakama_template( 'after-main', hakama_template_group() );
		?>
	</section>
<?php get_footer();
