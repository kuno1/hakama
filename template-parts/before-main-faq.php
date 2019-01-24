<?php
$product_id = hakama_document_parent();
?>
<section class="header-section header-section-faq">
	<div class="header-section-cover header-section-cover-faq">

	</div>
	<div class="container header-section-container">

		<div class="row">
			
			<div class="col-xs-12 col-sm-8">
				<div class="header-section-text">
					<?php if ( $product_id ) : ?>
						<?php echo wp_kses_post( sprintf( __( 'Help document of <a href="%s">%s</a>', 'hakama' ), get_permalink( $product_id ), get_the_title( $product_id ) ) ); ?>
					<?php else : ?>
						<?php esc_html_e( 'Help Center', 'hakama' ) ?>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-4">
				<?php echo do_shortcode( '[hamelp-search label="ヘルプ内を検索"][/hamelp-search]' ) ?>
				
				<p class="header-section-return text-right">
				<?php if ( $product_id ) : ?>
					<a href="<?php echo home_url( "/faq/of/$product_id" ) ?>" class="header-section-return-link">
						<i class="fa fa-file-alt"></i>
						<?php esc_html_e( 'See all document', 'hakama' ) ?>
					</a><br />
					<a href="<?php echo get_permalink( $product_id ) ?>" class="header-section-return-link">
						<i class="fa fa-arrow-alt-circle-left"></i>
						<?php esc_html_e( 'Product page', 'hakama' ) ?>
					</a>
				<?php elseif ( is_singular( 'faq' ) ) : ?>
					<a href="<?php echo get_post_type_archive_link( 'faq' ) ?>" class="header-section-return-link">
						<i class="fas fa-home"></i>
						<?php esc_html_e( 'Help Center Home', 'hakama' ) ?>
					</a>
				<?php endif; ?>
				</p>
			</div>
		</div>

	</div>

</section>