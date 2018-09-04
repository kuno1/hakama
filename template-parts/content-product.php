<div class="product-main col-sm-12 col-md-9">

	<?php hakama_template( 'content-product-gallery' ) ?>
	
	<div class="row product-main-buttons">
		<div class="col">
			<a class="btn btn-outline-primary btn-lg btn-block" href="<?php echo home_url( sprintf( '/faq/of/%d', get_the_ID() ) ) ?>">
				<i class="fa fa-file-signature"></i> <?php esc_html_e( 'Documentation', 'hakama' ); ?>
			</a>
		</div>
		<div class="col">
			<a class="btn btn-outline-primary btn-lg btn-block" href="#">
				<i class="fa fa-life-ring"></i> <?php esc_html_e( 'Support', 'hakama' ); ?>
			</a>
		</div>
	</div>
	
	<div class="entry-content product-main-content">
		<?php the_content(); ?>
	</div>
	
	

</div><!-- // product-main -->
