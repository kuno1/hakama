<?php

get_header(); ?>

<?php hakama_template( 'before-main', hakama_template_group() ) ?>
	
	<section class="section-main">
		
		<div class="container">
			
			<div class="row">
				
				<main id="content" class="col-sm-12 col-lg-9">
					
					<?php the_post(); ?>
					
					<?php hakama_template( 'header', 'product' ); ?>
					
					<?php hakama_template( 'entry-nav', hakama_template_group() ) ?>
					
					<h2 class="brand-title"><?php esc_html_e( 'Products', 'hakama' ) ?></h2>
					
					<?php
					$query = new WP_Query( [
						'post_parent'    => get_the_ID(),
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => -1,
					] );
					if ( $query->have_posts() ) : ?>
						<ul class="loop-list card-columns card-columns-small woocommerce">
							<?php global $product; while ( $query->have_posts() ) {
								$query->the_post();
								$product = wc_get_product();
								hakama_template( 'loop', get_post_type() );
							} wp_reset_postdata(); ?>
						</ul>
						<div class="text-center">
							<?php hakama_pagination() ?>
						</div>
					<?php else : ?>
						<div class="alert alert-secondary">
							<?php esc_html_e( 'This brand has no content yet.', 'hakama' ); ?>
						</div>
					
					<?php endif; ?>
					
					<h2 class="brand-title"><?php echo esc_html( \Kunoichi\Makibishi\Hooks\ActOnSpecifiedCommercialTransaction::get_instance()->get_label() ) ?></h2>
					
					<?php if ( hakama_brand_has_business() ) : ?>
						
						<?php hakama_template( 'brand', 'detail', [ 'user_id' => get_the_author_meta( 'ID' ) ] ) ?>

						<table class="table shop-detail-table">
							<?php foreach ( \Kunoichi\Makibishi\Hooks\ActOnSpecifiedCommercialTransaction::get_instance()->values() as $key => $values ): ?>
							<tr>
								<th>
									<?php echo esc_html( $values['label'] ) ?>
								</th>
								<td>
									<?php echo esc_html( $values['value'] ) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					<?php else : ?>
						<div class="alert alert-secondary">
							<?php esc_html_e( 'This brand has no business information yet.', 'hakama' ); ?>
						</div>
					<?php endif; ?>
					
					<?php hakama_template( 'after-main', hakama_template_group() ) ?>
					
				</main>

				<div class="col-sm-12 col-lg-3">
					<?php if ( $parent = hakama_document_parent() ) {
						get_sidebar( 'product' );
					} else {
						get_sidebar( get_post_type() );
					} ?>
				</div>
				
				
				
			</div>
			
		
		</div>
	
	
	</section>


<?php get_footer();