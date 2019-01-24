<?php
$product_id = hakama_document_parent();
?>
<section class="header-section header-section-thread">
	<div class="header-section-cover header-section-cover-thread" data-product-id="<?= $product_id ?>">

	</div>
	<div class="container header-section-container">

		<div class="row">
			
			<div class="col-xs-12 col-sm-8">
				<div class="header-section-text">
					<?php if ( $product_id ) : ?>
						<?php echo wp_kses_post( sprintf( __( 'Support Forum of <a href="%s">%s</a>', 'hakama' ), hakama_support_page( $product_id ), get_the_title( $product_id ) ) ); ?>
					<?php else : ?>
						<?php esc_html_e( 'Support Forum', 'hakama' ) ?>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-4">
				
				<p class="header-section-return text-right">
				<?php if ( $product_id ) : ?>
					<a href="<?php echo hakama_support_page( $product_id ) ?>" class="header-section-return-link">
						<i class="fas fa-home"></i>
						<?php esc_html_e( 'Support Forum Home', 'hakama' ) ?>
					</a><br />
					<a href="<?php echo get_permalink( $product_id ) ?>" class="header-section-return-link">
						<i class="fa fa-arrow-alt-circle-left"></i>
						<?php esc_html_e( 'Product page', 'hakama' ) ?>
					</a>
				<?php else : ?>
					<a href="<?php echo get_post_type_archive_link( 'thread' ) ?>" class="header-section-return-link">
						<i class="fas fa-home"></i>
						<?php esc_html_e( 'Support Forum Home', 'hakama' ) ?>
					</a>
				<?php endif; ?>
				</p>
			</div>
		</div>

	</div>

</section>