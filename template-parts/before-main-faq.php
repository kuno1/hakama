<?php

include __DIR__ . '/header-support.php';

if ( $product = hakama_get_current_product() ) :
	include __DIR__ . '/entry-nav-support.php';
else: ?>

	<div class="entry">

		<div class="<?php hakama_class_names( [
			'alignfull'         => true,
			'entry-nav-divider' => true,
			'no-border-top'     => get_query_var( 'no-border-top' ),
			'no-border-bottom'  => get_query_var( 'no-border-bottom' ),
		] ); ?>">

			<nav class="container">

				<ul class="entry-nav-list entry-nav-list-expandable justify-content-start">

					<?php
					$terms = get_terms( [ 'taxonomy' => 'faq_cat' ] );
					if ( $terms && ! is_wp_error( $terms ) ) :
						foreach ( $terms as $term ) :
					?>

					<li class="entry-nav-item">
						<a class="<?php hakama_class_names( [
							'entry-nav-link' => true,
							'active' => is_tax( $term->taxonomy, $term->term_id ) || ( is_singular() && has_term( $term->term_id, $term->taxonomy ) ),
						] );?>" href="<?php echo get_term_link( $term ); ?>">
							<?php echo esc_html( $term->name ) ?>
						</a>
					</li>

					<?php endforeach; endif; ?>

				</ul>
			</nav>
		</div>

	</div>

<?php endif;
