<?php
get_header();
hakama_template( 'breadcrumb' );
hakama_template( 'before-main', hakama_template_group() );
the_post();
?>


	<section class="section-main">

				<main id="content">

					<header class="brand-title-block">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php echo get_the_post_thumbnail( null, 'post-thumbnail', [ 'class' => 'brand-title-block-img support-by-author-thumbnail' ] ) ?>
						<?php endif; ?>
						<h1 class="support-by-author-title"><?php the_title() ?></h1>
					</header>

					<div class="text-center mb-5">
						<?php the_excerpt() ?>
					</div>

					<article class="entry entry-<?php echo esc_attr( get_post_type() ) ?>">
						<div class="entry-content entry-content-<?php echo esc_attr( get_post_type() ) ?> entry-content-business">
							<?php if ( hakama_brand_has_business() ) : ?>
								<h2 class="has-text-align-center is-style-overline">
									<?php echo esc_html( \Kunoichi\Makibishi\Hooks\ActOnSpecifiedCommercialTransaction::get_instance()->get_label() ) ?>
								</h2>

								<?php hakama_template( 'brand', 'detail', [ 'user_id' => get_the_author_meta( 'ID' ) ] ) ?>

								<table class="table shop-detail-table">
									<?php foreach ( \Kunoichi\Makibishi\Hooks\ActOnSpecifiedCommercialTransaction::get_instance()->values() as $key => $values ): ?>
										<tr>
											<th>
												<?php echo esc_html( $values[ 'label' ] ) ?>
											</th>
											<td>
												<?php echo esc_html( $values[ 'value' ] ) ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</table>
							<?php else : ?>
								<div class="alert alert-muted">
									<?php esc_html_e( 'This brand has no business information yet.', 'hakama' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</article>

					<div class="product-see-also alignfull">

						<div class="product-see-also-inner">
							<div class="product-see-also-blocks">
								<h2 class="has-text-align-center is-style-overline f-serif"><?php esc_html_e( 'Products', 'hakama' ) ?></h2>
								<?php
								$query = new WP_Query( [
									'post_parent' => get_the_ID(),
									'post_type' => 'product',
									'post_status' => 'publish',
									'posts_per_page' => -1,
								] );
								if ( $query->have_posts() ) : ?>
									<ul class="product-list">
										<?php while ( $query->have_posts() ) {
											$query->the_post();
											hakama_template( 'kbl/post-loop-product' );
										}
										wp_reset_postdata(); ?>
									</ul>
								<?php else : ?>
									<div class="alert alert-muted">
										<?php esc_html_e( 'This brand has no content yet.', 'hakama' ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

					</div>

					<article class="entry entry-<?php echo esc_attr( get_post_type() ) ?>">
						<div class="entry-content entry-content-<?php echo esc_attr( get_post_type() ) ?>">
							<?php if ( get_post()->post_content ) {
								// If not empty, echo content.
								the_content();
							} ?>
						</div>
						<?php hakama_template( 'entry-footer', get_post_type() ); ?>
					</article>


					<?php hakama_template( 'after-main', hakama_template_group() ) ?>

				</main>

	</section>


<?php get_footer();
