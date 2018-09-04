<?php
/**
 * Template overridden by hakama
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
get_header( 'shop' );
?>

	<section class="section-main">
		<div class="container">
			<?php do_action( 'woocommerce_before_main_content' ); ?>
			<div class="row">
				<main id="content" class="col-sm-12">

					<header class="woocommerce-products-header entry-meta">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h1 class="woocommerce-products-header__title entry-title entry-title-product">
								<?php woocommerce_page_title(); ?>
							</h1>
						<?php endif; ?>
						<?php do_action( 'woocommerce_archive_description' ); ?>
					</header>
					
					<?php if ( woocommerce_product_loop() ) :
						
						do_action( 'woocommerce_before_shop_loop' );
						
						woocommerce_product_loop_start();
						
						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();
								
								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );
								
								wc_get_template_part( 'content', 'product' );
							}
						}
						
						woocommerce_product_loop_end();
						
						do_action( 'woocommerce_after_shop_loop' );
					else :
						do_action( 'woocommerce_no_products_found' );
					endif;
					
					do_action( 'woocommerce_after_main_content' );
					?>

				</main>
			</div>
		</div>

	</section>


<?php get_footer();
