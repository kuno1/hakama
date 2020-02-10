<aside class="platform-support">

	<img class="platform-support-logo" src="<?php echo get_template_directory_uri() ?>/src/img/kunoichi-logo.svg" width="50" height="50" alt="" />

	<h2 class="platform-support-title"><?php echo esc_html_x( 'Need Help For Shopping?', 'platform-support', 'hakama' ) ?></h2>

	<p class="text-center">
		<?php esc_html_e( 'Need platform support? Please feel free to contact KUNOICHI support team.', 'hakama' ) ?>
	</p>

	<p class="text-center">
		<?php if ( is_user_logged_in() ) : ?>
			<?php if ( function_exists( 'hamethread_button' ) ) {
				hamethread_button( 0, __( 'Contact to Kunoichi Support', 'hakama' ), [
					'class'  => 'btn btn-outline-primary',
				] );
			} ?>
		<?php else : ?>
			<a class="btn btn-outline-primary" href="<?php hakama_login_url( $_SERVER['REQUEST_URI'] ) ?>">
				<?php esc_html_e( 'Login to Get Support', 'hakama' ) ?>
			</a>
		<?php endif; ?>
	</p>

</aside>
