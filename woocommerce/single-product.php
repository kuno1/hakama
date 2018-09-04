<?php
/**
 * Overridden tempalte by hakama
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */


get_header(); ?>

	<section class="section-main">

		<div class="container">
			<?php do_action( 'woocommerce_before_main_content' ); ?>

			<div class="row">

				<main id="content" class="col-sm-12">
					
					<?php while ( have_posts() ) : the_post(); ?>
						
						<?php wc_get_template_part( 'content', 'single-product' ); ?>
					
					<?php endwhile; // end of the loop. ?>
					
					<?php do_action( 'woocommerce_after_main_content' ); ?>
					
				</main>
			</div>
		</div>
	</section>

<?php get_footer();
