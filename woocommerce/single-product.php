<?php
/**
 * Overridden tempalte by hakama
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */


get_header();
hakama_template( 'breadcrumb' );
the_post();


// Change reivew title
add_filter( 'woocommerce_reviews_title', function( $title ) {
	return '';
} );
?>

	<section class="section-main">

		<main id="content">

			<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'entry entry-product', $product ); ?>>

				<?php do_action( 'woocommerce_before_single_product' ); ?>

				<header class="product-header">
					<h1 class="product-title"><?php the_title() ?></h1>
					<?php if ( $category = hakama_top_category() ) : ?>
					<div class="product-type">
						<?php echo esc_html( $category->name ) ?>
					</div>
					<?php endif; ?>
					<div class="product-excerpt">
						<?php the_excerpt(); ?>
					</div>
					<?php woocommerce_template_loop_price(); ?>
					<?php woocommerce_template_single_rating() ?>
				</header>

				<?php hakama_template( 'product-gallery' ) ?>

				<div class="product-meta alignfull">

					<div class="product-meta-inner">

						<div class="product-demo text-center">
							<?php $demo_url = get_post_meta( get_the_ID(), '_demo_url', true ); ?>
							<a class="product-demo-btn btn btn-<?php echo $demo_url ? 'primary' : 'outline-primary disabled' ?>"
								href="<?php echo $demo_url ? esc_url( $demo_url ) : '#' ?>" target="_blank"
								title="<?php echo $demo_url ? '' : esc_attr__( 'This product has no demo.', 'hakama' ) ?>">
								<?php if ( $demo_url ) : ?>
									<i class="far fa-eye"></i>
									<?php esc_html_e( 'Preview', 'hakama' ) ?>
								<?php else : ?>
									<i class="fas fa-eye-slash"></i>
									<?php esc_html_e( 'No Preview', 'hakama' ) ?>
								<?php endif; ?>
							</a>
							<a class="product-demo-btn btn btn-outline-primary disabled" href="#"
							   title="<?php esc_html_e( 'Coming Soon', 'hakama' ) ?>">
								<i class="fas fa-tachometer-alt"></i>
								<?php esc_html_e( 'Live(Coming Soon)', 'hakama' ) ?>
							</a>
						</div>

						<div class="product-tags">
							<i class="fas fa-tag"></i>
							<?php the_terms( get_the_ID(), 'product_tag' ) ?>
						</div>
						<p class="product-meta-paragraph text-center">
							Ver.
							<?php echo hakama_get_latest_version() ?: '---'; ?>
							<span class="product-meta-divider"></span>
							<?php esc_html_e( 'Last Updated: ', 'hakama' ) ?>
							<?php echo ( $updated = hakama_get_last_updated() ) ? mysql2date( get_option( 'date_format' ), $updated )  : '---'  ?>
							<span class="product-meta-divider"></span>
							<?php esc_html_e( 'License: 100% GPL', 'hakama' ) ?>
						</p>
					</div>

				</div>

				<?php hakama_template( 'entry-nav-support', '', [
					'no-border-top' => true,
				] ) ?>

				<div class="entry-content entry-content-product">
					<?php if ( get_post()->post_content ) : ?>
						<?php the_content(); ?>
					<?php else : ?>
						<div class="alert alert-warning text-center alert-transparent">
							<div class="alert-heading"><i class="fas fa-exclamation-circle"></i> <?php esc_html_e( 'No Description', 'hakama' ) ?></div>
							<div class="alert-body">
								<?php esc_html_e( 'This product has no description. Request author about details.', 'hakama' ) ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<?php hakama_template( 'link-share' ) ?>

				<div class="alignfull product-buy-wrapper">
					<div class="product-buy">
						<h2 class="product-buy-title is-style-overline has-text-align-center">
							<?php esc_html_e( 'Buy Product', 'hakama' ) ?>
						</h2>

						<div class="product-buy-now">
							<?php hakama_template( 'add-to-cart' ) ?>
						</div>

						<h3 class="product-buy-subtitle has-text-align-center">
							<?php esc_html_e( 'Support for Customers', 'hakama' ) ?>
						</h3>

						<figure class="wp-block-table">
							<table class="product-spec-table product-buy-table text-center">
								<thead>
								<tr>
									<th>&nbsp;</th>
									<th><?php esc_html_e( 'Everyone', 'hakama' ) ?></th>
									<th><?php esc_html_e( 'Customers', 'hakama' ) ?></th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<th><?php esc_html_e( 'Download', 'hakama' ) ?></th>
									<td><i class="fas fa-times text-muted"></i></td>
									<td><i class="fas fa-infinity text-success"></i></td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Public Documents', 'hakama' ) ?></th>
									<td><i class="far fa-circle text-success"></i></td>
									<td><i class="far fa-circle text-success"></i></td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Private Documents', 'hakama' ) ?></th>
									<td><i class="fas fa-times text-muted"></i></td>
									<td><i class="far fa-circle text-success"></i></td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Support Forum', 'hakama' ) ?></th>
									<td><i class="fas fa-times text-muted"></i></td>
									<td><i class="far fa-circle text-success"></i></td>
								</tr>
								</tbody>
							</table>
						</figure>

						<div class="product-review">
							<?php hakama_template( 'product-review' ) ?>
							<?php comments_template(); ?>
						</div>

					</div>
				</div>


				<div class="product-brand">

					<?php hakama_template( 'support-brand' ) ?>

				</div>

				<div class="product-see-also alignfull">

					<div class="product-see-also-inner">
						<?php hakama_template( 'product-see-also' ); ?>
					</div>

				</div>

				<div class="product-popular">

					<div class="product-popular-inner">
						<?php hakama_template( 'product-popular' ); ?>
					</div>

				</div>
			</article>

			<?php do_action( 'woocommerce_after_single_product' ); ?>

			<?php do_action( 'woocommerce_after_main_content' ); ?>

		</main>

	</section>

<footer class="product-floater">
	<div class="container">
		<?php the_post_thumbnail( 'thumbnail', [ 'class' => 'product-floater-image' ] ); ?>

		<div class="product-floater-buttons">
			<?php woocommerce_template_single_add_to_cart() ?>
		</div>
	</div>
</footer>

<?php get_footer();
