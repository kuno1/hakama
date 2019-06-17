<?php
$parent = hakama_document_parent();
?>
<footer class="main-footer thread-footer">
	
	<h2 class="main-footer-title thread-footer-title text-center">
		<?php if ( $parent ) : ?>
			<?php esc_html_e( 'Product Support', 'hakama' ) ?>
		<?php else : ?>
			<?php esc_html_e( 'Kunoichi Support', 'hakama' ) ?>
		<?php endif; ?>
	</h2>
	<p class="main-footer-lead text-center text-muted">
		<?php
		if ( $parent ) {
			echo esc_html( sprintf( __( 'Get Supported for %s.', 'hakama' ), get_the_title( $parent ) ) );
		} else {
			esc_html_e( 'Marketplace Support.', 'hakama' );
		}
		?>
	</p>
	
	<div class="row">
		
		<div class="col-xs-12 col-md-4">
			<div class="card">
				<div class="card-body">
					<i class="card-icon fa fa-file-signature text-info"></i>
					<h3 class="card-title text-center text-info"><?php esc_html_e( 'Documentation', 'hakama' ) ?></h3>
					<p class="card-text">
						<?php if ( $parent ) : ?>
							<?php printf( esc_html__( 'You may find helpful documents for %s. And if not, please feel free to request.', 'hakama' ), esc_html( get_the_title( $parent ) ) )  ?>
						<?php else : ?>
							<?php esc_html_e( 'These documents are for Kunoichi Marketplace. Feel free to make request for what you want to know!', 'hakama' ) ?>
						<?php endif; ?>
					</p>
					<p class="text-center">
						<?php hakama_document_link( $parent, __( 'See Documents', 'hakama' ), 'btn btn-outline-secondary' ) ?>
					</p>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-4">
			<div class="card">
				<div class="card-body">
					
					<i class="card-icon fa fa-life-ring text-primary"></i>
					<h3 class="card-title text-center text-primary"><?php esc_html_e( 'Get Supported By', 'hakama' ) ?></h3>

					<div class="card-icon-image">
						<?php echo hakama_brand_thumbnail( $parent ) ?>
					</div>
					
					<p class="card-text">
						<?php esc_html_e( 'All customers can get supported by product creator. You can refer resolved threads or start new one!', 'hakama' ) ?>
					</p>

					<p class="text-center">
						<?php if ( function_exists( 'hamethread_button' ) ) : ?>
							<?php if ( $parent && ! \Kunoichi\Makibishi::is_customer( $parent, get_current_user_id() ) ) : ?>
								<a href="<?php the_permalink( $parent ) ?>" class="btn btn-primary btn-block">
									<?php esc_html_e( 'Buy Product & Get Supported', 'hakama' ) ?>
								</a>
							<?php else : ?>
								<?php hamethread_button( $parent, __( 'Start Thread', 'hakama' ) ); ?>
							<?php endif; ?>
						<?php endif; ?>
					</p>
					
					<?php if ( ! is_post_type_archive( 'thread' ) ) : ?>
						<p class="text-center">
							<a class="btn btn-outline-primary btn-block" href="<?php echo hakama_support_page( $parent ) ?>">
								<?php esc_html_e( 'See Threads', 'hakama' ) ?>
							</a>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-md-4">
			<div class="card">
				<div class="card-body">
					<i class="fa fa-users card-icon text-warning"></i>
					<h3 class="card-title text-center text-warning"><?php esc_html_e( 'Contact Platform', 'hakama' ) ?></h3>
					<p class="card-text">
						<?php esc_html_e( 'Need platform support? Please feel free to contact KUNOICHI support team.', 'hakama' ) ?>
					</p>
					<p class="text-center">
						<?php if ( is_user_logged_in() ) : ?>
							<?php if ( function_exists( 'hamethread_button' ) ) {
								hamethread_button( 0, __( 'Contact To Support', 'hakama' ) );
							} ?>
						<?php else : ?>
							<a class="btn btn-outline-secondary btn-block" href="<?php hakama_login_url( $_SERVER['REQUEST_URI'] ) ?>">
								<?php esc_html_e( 'Login to Get Support', 'hakama' ) ?>
							</a>
						<?php endif; ?>
					</p>
					
				</div>
				
			</div>
		</div>
	</div><!-- // .row -->

</footer><!-- //main-footer -->
