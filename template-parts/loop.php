<?php
if ( ! isset( $count ) ) {
	$count = 3;
}
$product = 'product' === get_post_type() ? wc_get_product() : null;
$class_args = [ 'loop-item', 'card' ];
if ( ( $on_sale = $product && $product->is_on_sale() ) ) {
	$class_args[] = 'on-sale';
}
?>
<li <?php post_class( $class_args ) ?>>
	<div class="loop-card">
		<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'post-thumbnail', [ 'class' => 'card-img-top' ] ) ?>
		</a>
		<?php endif; ?>
		<div class="card-body">
			<h2 class="loop-title card-title">
				<?php the_title() ?>
				<?php if ( $on_sale ) : ?>
				<small class="text-danger"><?php esc_html_e( 'on Sale!', 'hakama' ) ?></small>
				<?php endif; ?>
				<?php if ( 'private' === get_post_status() ) : ?>
					<i class="fa fa-lock"></i>
				<?php endif; ?>
			</h2>

			<?php if ( $product ) : ?>
			<div class="card-sub-title clearfix card-price">
				<?php woocommerce_template_loop_rating(); ?>
				<?php woocommerce_template_loop_price(); ?>
			</div>
			<?php endif; ?>

			<p class="card-subtitle entry-meta-subtitle text-muted loop-meta mb-2">
				<?php if ( in_array( get_post_type(), [ 'post', 'faq', 'thread' ] ) ) : ?>
					<span class="d-inline-block">
						<i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ) ?>
					</span>
					<span class="d-inline-block">
						<i class="fa fa-user"></i> <?php
							$brand = hakama_get_author_brand();
							if ( $brand ) {
								echo esc_html( get_the_title( $brand ) );
							} else {
								the_author();
							}
						?>
					</span>
					<span class="d-inline-block">
						<i class="far fa-comment"></i> <?php comments_number( __( '0 comment', 'hakama' ) ) ?>
					</span>
				<?php endif; ?>
				<?php

				?>
			</p>

			<?php switch ( get_post_type() ) : case 'product': ?>
				<p>
					<?php woocommerce_template_loop_add_to_cart() ?>
				</p>
				<p>
					<a class="btn btn-outline-secondary btn-block" href="<?php the_permalink() ?>">
						<?php esc_html_e( 'Detail', 'hakama' ) ?>
						<i class="fa fa-arrow-alt-circle-right"></i>
					</a>
				</p>

			<?php break; default : ?>
				<div class="text-center">
					<a href="<?php the_permalink() ?>" class="btn btn-link btn-sm">
						<?php esc_html_e( 'Read More', 'hakama' ); ?>
						<i class="fa fa-arrow-alt-circle-right"></i>
					</a>
				</div>
			<?php break; endswitch; ?>

		</div>
		<?php hakama_the_loop_type( '<span class="loop-type">', '</span>' ) ?>
	</div>

</li>
