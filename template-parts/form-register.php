<?php
/** @var bool $is_connected */
/** @var bool $is_seller */
/** @var string $url */
wp_enqueue_script( 'makibishi-shop-detail' );
$js = <<<JS
	new Vue({
		el: '#brand-detail'
	});
JS;
wp_add_inline_script( 'makibishi-shop-detail', $js );
global $wp_scripts;
?>
<div class="seller-submission">
	
	
	<?php if ( $is_seller ) : ?>

		<h2 class="seller-submission-title"><?php esc_html_e( 'Congratulations!', 'hakama' ) ?></h2>
		
		<p class="seller-submission-description">
			<?php esc_html_e( 'Now you became seller, so please go to dashboard and start setting up your products.', 'hakama' ) ?>
		</p>
		<p class="text-center">
			<a class="btn btn-outline-primary btn-lg"
			   href="<?php echo \Hametuha\Hashboard::screen_url() ?>"><?php esc_html_e( 'Go Dashboard', 'hakama' ) ?></a>
		</p>
		<div id="brand-detail" class="seller-submission-business" style="position: relative">
			<h2 class="seller-submission-title"><?php esc_html_e( 'Your Business Information', 'hakama' ) ?></h2>
			<shop-detail id="<?php echo get_current_user_id() ?>"></shop-detail>
		</div>
	
	<?php elseif ( ! current_user_can( 'read' ) ) : ?>

		<p class="seller-submission-description">
			<?php esc_html_e( 'To become seller, you need Kunoichi account. Please sign up and come back this page again!', 'hakama' ) ?>
		</p>
		<p class="text-center">
			<a class="btn btn-outline-primary btn-lg"
			   href="<?php echo hakama_registration_url( get_permalink() ) ?>"><?php esc_html_e( 'Sign Up', 'hakama' ) ?></a>
		</p>
		<p class="text-center text-muted">
			<?php echo wp_kses_post( sprintf( __( 'Do you have account? Please <a href="%s">login</a>.', 'hakama' ), hakama_login_url( get_permalink() ) ) ) ?>
		</p>
	
	<?php else : ?>
		<?php if ( $error = \Kunoichi\Makibishi\Controller\SellerManager::get_instance()->flush_error( get_current_user_id() ) ) : ?>

			<div class="alert alert-danger">
				<?php echo wp_kses_post( $error ) ?>
			</div>
		
		<?php endif; ?>
		
		
		<?php if ( ! $is_connected ) : ?>


			<p class="seller-submission-description">
				<?php esc_html_e( 'Please connect stripe account to prove your business entity. If you don\'t have one, you can create new account through the connection process.', 'hakama' ) ?>
			</p>


			<p class="text-center">
				<a class="btn btn-outline-info btn-lg"
				   href="<?php echo esc_url( $url ) ?>"><?php esc_html_e( 'Connect with Stripe', 'hakama' ) ?></a>
			</p>

			<p class="text-center text-muted">
				<?php echo wp_kses_post( sprintf( __( 'Do you have something to hesitate yourself? See our <a href="%s">documentation</a>.', 'hakama' ), get_post_type_archive_link( 'faq' ) ) ) ?>
			</p>
		
		<?php endif; ?>
	
	
	<?php endif; ?>

</div>
