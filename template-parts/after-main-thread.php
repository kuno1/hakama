<?php
$parent = hakama_document_parent();
?>
<footer class="main-footer thread-footer">
	
	<h2 class="main-footer-title thread-footer-title text-center">
		<?php esc_html_e( 'Product Support', 'hakama' ) ?>
	</h2>
	<p class="main-footer-lead">
	
	</p>
	
	<div class="row justify-content-around">
		
		<div class="col-xs-12 col-md-3">
			<div class="card">
				<div class="card-body">
					<i class="card-icon fa fa-file-signature text-info"></i>
					<h3 class="card-title text-center text-info"><?php esc_html_e( 'Documentation', 'hakama' ) ?></h3>
					<p class="card-text">
						<?php printf( esc_html__( 'You may find helpful documents for %s. And if not, please feel free to request.', 'hakama' ), esc_html( get_the_title( $parent ) ) )  ?>
					</p>
					<p class="text-center">
						<a class="btn btn-outline-secondary" href="<?php echo hakama_documentation_url( $parent ) ?>">
							<?php esc_html_e( 'See Documents', 'hakama' ) ?>
						</a>
					</p>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-4">
			<div class="card">
				<div class="card-body">
					
					<h3 class="card-title text-center"><?php esc_html_e( 'Get Supported By', 'hakama' ) ?></h3>

					<div class="card-icon-image">
						<?php echo hakama_brand_thumbnail( $parent ) ?>
					</div>
					
					<p class="card-text">
						<?php esc_html_e( 'All customers can get supported by product creator. You can refer resolved threads or start new one!', 'hakama' ) ?>
					</p>

					<p class="text-center">
						
						<?php if ( function_exists( 'hamethread_button' ) ) {
							hamethread_button( $parent, __( 'Start Thread', 'hakama' ) );
						} ?>
						
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
		
		<div class="col-xs-12 col-md-3">
			<div class="card">
				<div class="card-body">
					<i class="fa fa-users card-icon text-warning"></i>
					<h3 class="card-title text-center text-warning"><?php esc_html_e( 'Contact Platform', 'hakama' ) ?></h3>
					<p class="card-text">
						<?php esc_html_e( 'Need platform support? Please feel free to contact KUNOICHI support team.', 'hakama' ) ?>
					</p>
					<p class="text-center">
						<a class="btn btn-outline-secondary" href="<?php echo get_post_type_archive_link( 'thread' ) ?>">
							<?php esc_html_e( 'Contact', 'hakama' ) ?>
						</a>
					</p>
					
				</div>
				
			</div>
		</div>
	</div><!-- // .row -->

</footer><!-- //main-footer -->
