<footer class="entry-footer">
	
	<?php if ( $post->post_parent ) : ?>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<p>

					<a class="btn btn-outline-primary btn-lg btn-block" href="<?php echo home_url( "/faq/of/{$post->post_parent}" ) ?>">
						<i class="fa fa-file-signature"></i>
						<?php esc_html_e( 'All Documentation', 'hakama' ) ?>
					</a>
				</p>
			</div>
			<div class="col-xs-12 col-md-6">
				<p>
					<a class="btn btn-outline-primary btn-lg btn-block"
					   href="<?php echo get_permalink( $post->post_parent ) ?>">
						<i class="fa fa-arrow-circle-left"></i>
						<?php esc_html_e( 'Product page', 'hakama' ); ?>
					</a>
				</p>
			</div>
		</div>
	
	<?php endif; ?>
	
	<?php comments_template() ?>

</footer>
