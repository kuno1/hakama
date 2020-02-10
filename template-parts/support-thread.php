<?php
if ( ! ( $product = hakama_get_current_product() ) ) {
	return;
}
?>
<aside class="platform-thread">

	<i class="fas fa-heart platform-thread-logo"></i>

	<h2 class="platform-thread-title"><?php echo esc_html_x( 'Get Support', 'platform-support', 'hakama' ) ?></h2>

	<p class="text-center">
		<?php echo wp_kses_post( __( 'Are you in trouble or having something to ask about this product?<br />You can get support from product author!', 'hakama' ) ) ?>
	</p>

	<p class="text-center">
		<?php if ( is_user_logged_in() ) : ?>
			<?php if ( hakama_is_customer( $product ) && function_exists( 'hamethread_button' ) ) :
				hamethread_button( $product->ID, __( 'Start Support Thread', 'hakama' ), [
					'class'  => 'btn btn-outline-light',
					'prefix' => '<i class="fas fa-plus-circle"></i>',
				] );
			else : ?>
				<a class="btn btn-outline-light" href="<?php the_permalink( $product ) ?>">
					<i class="fas fa-shopping-cart"></i>
					<?php esc_html_e( 'Go Shopping to Get Support', 'hakama' ) ?>
				</a>
			<?php endif; ?>
		<?php else : ?>
			<a class="btn btn-outline-light" href="<?php echo hakama_login_url( home_url( sprintf( 'support/%d', $product->ID ) ) ) ?>">
				<?php esc_html_e( 'Login to Get Support', 'hakama' ) ?>
			</a>
		<?php endif; ?>
	</p>

</aside>
