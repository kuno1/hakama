<header class="product-header">
	
	<div class="product-header-title">
		
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="product-header-image">
				<?php the_post_thumbnail() ?>
			</div>
		<?php endif; ?>
		<div class="product-header-content">
			<h1 class="entry-title">
				<?php the_title() ?>
				<span class="badge badge-secondary">
					<?php
					$cats = get_the_terms( get_the_ID(), 'product_cat' );
					if ( $cats && ! is_wp_error( $cats ) ) {
						echo implode( ', ', array_map( function( $cat ) {
							return esc_html( $cat->name );
						}, $cats ) );
					}?>
				</span>
			</h1>
			<?php woocommerce_template_single_rating(); ?>
			<?php if ( has_excerpt() ) : ?>
				<div class="product-header-excerpt">
					<?php the_excerpt() ?>
				</div>
			<?php endif ?>
		</div>
		
	</div>
	
</header>
