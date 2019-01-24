<div class="product-main col-sm-12 col-md-9">

	<?php hakama_template( 'content-product-gallery' ) ?>
	
	<div class="row product-main-buttons">
		<div class="col mb-1">
			<?php hakama_document_link( get_the_ID(), '', 'btn btn-outline-primary btn-lg btn-block', 'file-signature' ) ?>
		</div>
		<div class="col mb-1">
			<?php $demo = get_post_meta( get_the_ID(), '_demo_url', true ); ?>
			<a class="btn btn-outline-primary btn-lg btn-block<?php echo $demo ? '' : ' disabled' ?>" href="<?php echo esc_url( $demo ?: '#' ) ?>" target="_blank">
				<i class="far fa-eye"></i> <?php esc_html_e( 'Demo', 'hakama' ); ?>
			</a>
		</div>
		<div class="col mb-1">
			<a class="btn btn-outline-primary btn-lg btn-block" href="<?php echo hakama_support_page() ?>">
				<i class="fa fa-life-ring"></i> <?php esc_html_e( 'Support', 'hakama' ); ?>
			</a>
		</div>
	</div>
	
	<div class="entry-content product-main-content">
		<?php the_content(); ?>
	</div>

</div><!-- // product-main -->
