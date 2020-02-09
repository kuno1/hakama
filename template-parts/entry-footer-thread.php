<footer class="entry-footer entry-footer-thread">

	<?php if ( hakama_can_read_post() ) : ?>
		<?php comments_template() ?>
	<?php else : ?>

		<div class="alert alert-warning text-center">
			<div class="alert-heading">
				<i class="far fa-comments"></i> <?php esc_html_e( 'Replies', 'hakama' ) ?>
			</div>
			<div class="alert-body">
				<?php echo wp_kses_post( sprintf(
					__( 'This thread is only for customers. Please <a href="%s" class="alert-link">login</a> or <a class="alert-link" href="%s">buy the product</a> to see the details.', 'hakama' ),
					wp_login_url( get_permalink() ),
					get_permalink( get_post()->post_parent )
				) ) ?>
			</div>
		</div>

	<?php endif; ?>

</footer>
